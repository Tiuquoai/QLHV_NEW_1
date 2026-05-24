from pydantic import BaseModel

class MessagePayload(BaseModel):
    # email: str
    message: str
    role: str 
