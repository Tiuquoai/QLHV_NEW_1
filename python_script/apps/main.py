from fastapi import FastAPI
from pydantic import BaseModel
from sentence_transformers import SentenceTransformer
import pandas as pd
from qdrant_client import QdrantClient
from qdrant_client.models import Distance, VectorParams, PointStruct
from pathlib import Path
from dotenv import load_dotenv
import requests
import os


BASE_DIR = Path(__file__).resolve().parent
load_dotenv(BASE_DIR / ".env")

app = FastAPI()

# load 1 lần duy nhất
model = SentenceTransformer('BAAI/bge-m3')
client = QdrantClient(os.getenv('QDRANT_URL'))
collection_name = "iuh_subjects"

API_KEY = os.getenv('API_KEY')

URL = os.getenv('GROQ_CLOUD_URL')


class RequestData(BaseModel):
    text: str
    
class RequestCallOpenAi(BaseModel):
    message : str 
    asking : str
    
    
    
@app.post("/embedding")
def embed(data: RequestData):
    
    vector = model.encode(data.text).tolist()
    return { "vector" : vector }



# call api từ python

@app.post("/chat")
def callOpenAi (data : RequestCallOpenAi):
    
    # print(data.message)
    
    # print("/n")
    
    # print(data.asking)
    
    payload = {
        "model": "llama-3.3-70b-versatile",
        "messages": [
            {"role": "system", "content": data.message },
            {"role": "user", "content": data.asking}
        ],
        "temperature": 0.2
    }
    
    # return  {
    #     "url" : os.getenv('QDRANT_URL'),
    #     "api" : API_KEY
    # }
    
    headers = {
        "Content-Type": "application/json",
        "Authorization": f"Bearer {API_KEY}"
    }
    
    

    res = requests.post(URL, json=payload, headers=headers)

    return res.json()

# # @app.get("/run")
# # def add_data ():
#         # ======================
#     # LOAD DATA
#     # ======================
#     BASE_DIR = Path(__file__).resolve().parent
#     # print('okelalalala')
#     file_path = BASE_DIR / "static" / "train_chatbot_iuh_fit_4nganh_30mon_capnhat.csv"
#     df = pd.read_csv(file_path)
#     print(df)
#     # fix hidden space trong header
#     df.columns = df.columns.str.strip()

#     # ======================
#     # CREATE COLLECTION
#     # ======================
#     print("Đang tạo collection...")

#     client.recreate_collection(
#         collection_name=collection_name,
#         vectors_config=VectorParams(
#             size=1024,
#             distance=Distance.COSINE
#         ),
#     )

#     # ======================
#     # BUILD POINTS
#     # ======================
#     points = []

#     print("Đang encode + đóng gói dữ liệu...")

#     for idx, row in df.iterrows():

#         text = f"{row['machuyennganh']} {row['tenhocphan']} {row['goi_y_hoc']}"

#         vector = model.encode(text).tolist()
        
#         text_content = (
#             f"Môn học {row['tenhocphan']} thuộc ngành {row['tenchuyennganh']}. "
#             f"Nhóm môn: {row['nhom_mon']}. "
#             f"Mô tả: {row['mo_ta_train']} "
#             f"Sau khi học bạn sẽ: {row['hoc_duoc_gi']} "
#             f"Lời khuyên: {row['goi_y_hoc']}"
#         )

#         payload_data = {
#             "text_content": text_content,
#             "machuyennganh": row["machuyennganh"],
#             "tenhocphan": row["tenhocphan"],
#             "goi_y_hoc": row["goi_y_hoc"],
#             "tenchuyennganh": row["tenchuyennganh"],
#             "nhom_mon": row["nhom_mon"]
#         }
        
#         # row['text_content'] = (f"Môn học {row['tenhocphan']} thuộc ngành {row['tenchuyennganh']}. "
#         #     f"Nhóm môn: {row['nhom_mon']}. "
#         #     f"Mô tả: {row['mo_ta_train']} "
#         #     f"Sau khi học bạn sẽ: {row['hoc_duoc_gi']} "
#         #     f"Lời khuyên: {row['goi_y_hoc']}")

#         # payload_data = {
#         #     "machuyennganh": row["machuyennganh"],
#         #     "tenhocphan": row["tenhocphan"],
#         #     "goi_y_hoc": row["goi_y_hoc"],
#         #     # "source_url": row["source_url"]
#         # }

#         points.append(
#             PointStruct(
#                 id=idx + 1,
#                 vector=vector,
#                 payload= payload_data
#             )
#         )

#         # ======================
#         # UPSERT TO QDRANT
#         # ======================
#         print(f"Đang push {len(points)} vectors...")
        
#     # print()

#     client.upsert(
#         collection_name=collection_name,
#         points=points
#     )

#     print("✅ DONE - dữ liệu đã lên Qdrant")