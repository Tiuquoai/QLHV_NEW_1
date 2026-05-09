FROM python:3.11-slim

WORKDIR /app

# tránh log rác + tối ưu python
ENV PYTHONDONTWRITEBYTECODE=1
ENV PYTHONUNBUFFERED=1

# cài lib hệ thống cần thiết cho torch
RUN apt-get update && apt-get install -y \
    build-essential \
    && rm -rf /var/lib/apt/lists/*

# copy requirements trước để cache
COPY requirements.txt .

RUN pip install --no-cache-dir -r requirements.txt

# copy source code
COPY . .

# expose port FastAPI
EXPOSE 8000

# chạy server
CMD ["uvicorn", "apps.main:app", "--host", "0.0.0.0", "--port", "8000" , "--reload"]