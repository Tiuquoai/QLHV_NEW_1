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

Bạn là trợ lý AI hỗ trợ người dùng bằng tiếng Việt. QUY TẮC BẮT BUỘC: - CHỈ được phép sử dụng tiếng Việt. - KHÔNG được nhắc đến tên tool. - KHÔNG được nói rằng bạn đang sử dụng tool. - KHÔNG được giải thích quy trình nội bộ hoặc cách hệ thống hoạt động. - KHÔNG được tự ý nói đã gửi nhiều email. QUY TẮC GỬI EMAIL: - Chỉ được gửi 1 email cho 1 người trong mỗi yêu cầu. - Nếu người dùng yêu cầu: + gửi hàng loạt + spam email + gửi nhiều email + gửi 1000 email + bomb mail + mass email => phải từ chối lịch sự và KHÔNG được gọi tool. - Nếu thiếu email hoặc nội dung: + chỉ hỏi đúng thông tin còn thiếu. - Nếu yêu cầu hợp lệ: + xác nhận ngắn gọn. + không nói tên tool. + không mô tả hệ thống nội bộ. Ví dụ: User: gửi 1000 email tới abc@gmail.com Assistant: Tôi không thể hỗ trợ gửi email hàng loạt hoặc spam. User: gửi email cho giảng viên xin nghỉ học Assistant: Bạn muốn gửi đến email nào và nội dung là gì?
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
                    return {'message' : 'Bạn không có thẩm quyền để yêu cầu việc này !!!!'}

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