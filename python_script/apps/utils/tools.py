from langchain_core.tools import tool
from langchain_ollama import ChatOllama
from dotenv import load_dotenv
import os
import aiosmtplib
from pathlib import Path

from email.message import EmailMessage

env_path = Path(__file__).resolve().parent.parent / '.env'
load_dotenv(env_path)



async def _to_list(cursor):
    return [doc async for doc in cursor]


class tools_func:

    @tool
    async def sending_email(email1: str, content: str) -> dict:
        """
        Gửi email đến một người nào đó khi user yêu cầu.
        """
        try:
            message = EmailMessage()
            message["From"] = os.getenv("MAIL_USER")
            message["To"] = email1
            message["Subject"] = "Trung Tam Quan Tri He Thong LMS"
            message.set_content(content)

            html_content = f"""
            <div style="font-family: Arial; line-height: 1.8;">
                <h2>Tin nhắn mới từ ADMIN</h2>
                <p>{content}</p>
            </div>
            """
            message.add_alternative(html_content, subtype="html")

            await aiosmtplib.send(
                message,
                hostname=os.getenv("MAIL_HOST"),
                port=int(os.getenv("MAIL_PORT")),
                username=os.getenv("MAIL_USER"),
                password=os.getenv("MAIL_PASS"),
                start_tls=True
            )
            return {"message": f"Đã gửi email đến {email1}"}
        except Exception as e:
            print(e)
            return {"message": "Gửi email thất bại", "error": str(e)}
        
        
    @tool
    async def all_sinhvien(ten: str = "") -> dict:
        """
        Liệt kê toàn bộ sinh viên có trong hệ thống.
        Tìm kiếm theo tên sinh viên (dùng REGEX, không phân biệt hoa thường).
        Trả về danh sách gồm: id, tên, mã sinh viên, giới tính, ngày sinh, SĐT,
        khoa, lớp, cơ sở đào tạo, trạng thái và thông tin tài khoản.
        """
        try:
            from apps.config import conn_mysql

            cursor = conn_mysql.cursor(dictionary=True)

            query = """
                SELECT
                    *
                FROM sinhvien sv
                JOIN `user` u ON sv.user_id = u.user_id
                WHERE 1=1
            """
            params = []

            if ten:
                query += " AND sv.tensinhvien REGEXP %s"
                params.append(ten)

            query += " ORDER BY sv.id_sinhvien DESC"

            cursor.execute(query, params)
            rows = cursor.fetchall()
            cursor.close()

            trangthai_map = {0: "Khóa", 1: "Hoạt động", 2: "Bảo lưu"}
            sinhvien_list = []
            for row in rows:
                sinhvien_list.append({
                    "id": row["id_sinhvien"],
                    "user_id": row["user_id"],
                    "tensinhvien": row["tensinhvien"],
                    "masosinhvien": row["masosinhvien"],
                    "gioitinh": row["gioitinh"],
                    "ngaysinh": row["ngaysinh"],
                    "sdt": row["sdt"],
                    "khoa": row["khoa"],
                    "lop": row["lopCN"],
                    "cosodaotao": row["cosodaotao"],
                    "trangthai": trangthai_map.get(row["trangthai"], f"Trạng thái {row['trangthai']}"),
                    "username": row["tenuser"],
                    "email": row["email"],
                    "trangthai_taikhoan": row["trangthai"],
                })

            if not sinhvien_list:
                return {"message": "Không tìm thấy sinh viên nào.", "sinhviens": []}

            return {
                "message": f"Tìm thấy {len(sinhvien_list)} sinh viên.",
                "total": len(sinhvien_list),
                "sinhviens": sinhvien_list,
            }

        except Exception as e:
            print(f"[all_sinhvien] Lỗi truy vấn MySQL: {e}")
            return {"message": "Không thể truy vấn danh sách sinh viên.", "error": str(e)}
        
    # @tool
    # async def all_expert() -> dict:
    #     """
    #     Liệt kê toàn bộ chuyên gia có trong hệ thống.
    #     Trả về danh sách tên, chuyên ngành, cấp bậc, nơi giảng dạy, giá và trạng thái của mỗi chuyên gia.
    #     """
    #     try:
    #         print(f"[all_expert] DB={DATABASE_NAME}, URI={MONGO_URL}")
    #         cursor = users_collection.find({"roleName": "expert"})
    #         print(f"[all_expert] Cursor type: {type(cursor)}")

    #         docs = await _to_list(cursor)
    #         print(f"[all_expert] Raw docs count: {len(docs)}")

    #         if docs:
    #             print(f"[all_expert] First doc keys: {list(docs[0].keys())}")
    #             print(f"[all_expert] First doc roleName: {docs[0].get('roleName')}")
    #             print(f"[all_expert] First doc expertProfile: {docs[0].get('expertProfile')}")

    #         level_map = {
    #             "bachelor": "Cử nhân",
    #             "master": "Thạc sĩ",
    #             "doctor": "Tiến sĩ",
    #             "professor": "Giáo sư",
    #         }

    #         experts = []
    #         for doc in docs:
    #             profile = doc.get("expertProfile") or {}
    #             level_raw = profile.get("level") or ""
    #             level_display = level_map.get(level_raw.lower(), level_raw or "Không rõ")

    #             experts.append({
    #                 "id": str(doc.get("_id", "")),
    #                 "name": doc.get("name") or "Không rõ",
    #                 "email": doc.get("email") or "Không rõ",
    #                 "major": profile.get("major") or "Không rõ",
    #                 "level": level_display,
    #                 "teachAt": profile.get("teachAt") or "Không rõ",
    #                 "information": profile.get("information") or "",
    #                 "price": profile.get("price") or 0,
    #                 "status": doc.get("statusAccount") or "Không rõ",
    #                 "avatar": doc.get("fileAvartarUrl") or "",
    #             })

    #         if not experts:
    #             return {"message": "Hiện tại không có chuyên gia nào trong hệ thống.", "experts": []}

    #         return {
    #             "message": f"Tìm thấy {len(experts)} chuyên gia trong hệ thống.",
    #             "total": len(experts),
    #             "experts": experts
    #         }

    #     except Exception as e:
    #         print(f"[all_expert] Lỗi truy vấn MongoDB: {e}")
    #         return {"message": "Không thể truy vấn danh sách chuyên gia.", "error": str(e)}