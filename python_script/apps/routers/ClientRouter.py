from fastapi import APIRouter
from ..controllers import AgenticController

from ..interfaces import MessagePayload

router = APIRouter(prefix="/chat-ai")

agenticController = AgenticController()



@router.post("")
async def get_users(payload : MessagePayload):
    # print(payload)
    return await agenticController.pickToolsFunc(payload.message, payload.role )
    # return {
    #     "message" : "kakakakaka"
    # }