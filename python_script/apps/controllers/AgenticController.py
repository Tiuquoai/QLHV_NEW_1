from langchain_core.tools import tool
from langchain_groq import ChatGroq
from ..utils import tools_func
import os
from apps.config import *

class AgenticController:

    def __init__(self):

        self.all_tool = tools_func()

        print(os.getenv('MODEL_NAME'))

        llm_init = ChatGroq(
            model=os.getenv('MODEL_NAME'),
            groq_api_key=os.getenv('GROQ_CLOUD_API'),
            temperature=0
        )
        
        self.llm = llm_init.bind_tools([
            self.all_tool.sending_email,
            self.all_tool.all_sinhvien   
        ])
        


    async def pickToolsFunc(self, message: str, roleName: str) -> dict:

        message = message + """
        LƯU Ý:
        - CHỈ ĐƯỢC PHÉP SỬ DỤNG NGÔN NGỮ TIẾNG VIỆT
        - Nếu user yêu cầu gửi email thì phải dùng tool sending_email
        """

        try:

            result = await self.llm.ainvoke(message)

            tool_call = (
                result.tool_calls[0]
                if getattr(result, "tool_calls", None)
                else None
            )

            if tool_call:

                tool_name = tool_call['name']
                tool_args = tool_call.get('args') or {}

                if tool_name == 'sending_email' and roleName == 'admin':

                    return await self.all_tool.sending_email.ainvoke({
                        "email1": tool_args.get('email1', ''),
                        "content": tool_args.get('content', '')
                    })
                
                elif tool_name == 'all_sinhvien' and roleName == 'admin':

                    return await self.all_tool.all_sinhvien.ainvoke({
                        "ten": tool_args.get('ten', '')
                    })
                
                else:
                    return {'message' : 'bạn không có thẩm quyền để yêu cầu việc này !!!!'}

            return {
                "message": (
                    result.content
                    if hasattr(result, 'content')
                    else "Không có phản hồi."
                )
            }

        except Exception as e:

            print("ERROR:", e)

            return {
                "message": "Có lỗi xảy ra",
                "error": str(e)
            }
            
    # async def 