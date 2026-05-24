from fastapi import FastAPI
from pydantic import BaseModel
from sentence_transformers import SentenceTransformer
from  apps.routers import ClientRouter
from dotenv import load_dotenv
import os
from pathlib import Path

from qdrant_client import QdrantClient
from qdrant_client.models import (
    VectorParams,
    Distance,
    PointStruct
)

import pandas as pd

# from qdrant_client import QdrantClient
# from qdrant_client.models import (
#     VectorParams,
#     Distance,
#     PointStruct
# )

app = FastAPI()

COLLECTION_NAME = "iuh_subjects"
# =========================
# QDRANT
# =========================
client = QdrantClient(
    url="http://localhost:6333"
)

model = SentenceTransformer('BAAI/bge-m3')

env_path = (
    Path(__file__)
    .resolve()
    .parent / '.env'
)
class RequestData(BaseModel):
    text: str
    
    
    
load_dotenv(env_path)

app.include_router(ClientRouter.router)

print(os.getenv('MODEL_NAME'))


@app.get('/')
def home ():
    return {
        "message" : "Hello chào bạn đã đến đây hehehehehehehehehe"
    }
    
@app.post('/chat')
def embed(data: RequestData):
    
    vector = model.encode(data.text).tolist()
    return { "vector" : vector }


@app.get('/add-data')
def add_data_to_embbedding ():
    # =====================
    # READ EXCEL
    # =====================
    file_path = "dulieudauvao.xlsx"

    df = pd.read_excel(    Path(__file__)
    .resolve()
    .parent / 'dulieudauvao.xlsx' )

    # =====================
    # CREATE COLLECTION
    # =====================
    collections = client.get_collections().collections
    collection_names = [c.name for c in collections]

    if COLLECTION_NAME not in collection_names:

        client.create_collection(
            collection_name=COLLECTION_NAME,
            vectors_config=VectorParams(
                size=1024,
                distance=Distance.COSINE
            )
        )

    # =====================
    # CREATE POINTS
    # =====================
    points = []

    for idx, row in df.iterrows():

        text = str(row.get("text_content", ""))

        # skip empty
        if text.strip() == "":
            continue

        # =================
        # EMBEDDING
        # =================
        vector = model.encode(text).tolist()

        # =================
        # PAYLOAD
        # =================
        payload = {
            "machuyennganh": str(row.get("machuyennganh", "")),
            "tenchuyennganh": str(row.get("tenchuyennganh", "")),
            "tenhocphan": str(row.get("tenhocphan", "")),
            "nhom_mon": str(row.get("nhom_mon", "")),
            "tinh_chat_mon": str(row.get("tinh_chat_mon", "")),
            "mo_ta_train": str(row.get("mo_ta_train", "")),
            "hoc_duoc_gi": str(row.get("hoc_duoc_gi", "")),
            "goi_y_hoc": str(row.get("goi_y_hoc", "")),
            "text_content": text
        }

        point = PointStruct(
            id=idx,
            vector=vector,
            payload=payload
        )

        points.append(point)

    # =====================
    # UPSERT
    # =====================
    client.upsert(
        collection_name=COLLECTION_NAME,
        points=points
    )

    return {
        "message": "Add dữ liệu thành công 😼",
        "total": len(points)
    }