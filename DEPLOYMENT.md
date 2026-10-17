# Triển khai Linux (Docker Compose)

## Yêu cầu

- Linux 64-bit, Docker Engine và Docker Compose plugin hiện hành.
- DNS/TLS reverse proxy (Caddy, Traefik, Nginx hoặc load balancer) ở phía trước nếu truy cập từ Internet.
- Không commit file `.env` hoặc các bản sao database.

## Triển khai lần đầu

```bash
cp .env.example .env
sed -i "s/^APP_KEY=.*/APP_KEY=base64:$(openssl rand -base64 32)/" .env
```

Sửa `.env` và thay tất cả giá trị `change-with-*` bằng secret ngẫu nhiên riêng biệt. Nếu TLS kết thúc ở reverse proxy, đặt `APP_URL=https://ten-mien` và `SESSION_SECURE_COOKIE=true`.

```bash
docker compose config --quiet
docker compose build --pull
docker compose up -d db
docker compose run --rm app php artisan migrate --force
docker compose up -d
docker compose ps
curl -fsS http://127.0.0.1:8080/up
```

Mặc định web chỉ bind `127.0.0.1:8080`. Chỉ đặt `APP_BIND_ADDRESS=0.0.0.0` khi firewall và TLS reverse proxy đã được cấu hình.

## Nâng cấp

```bash
docker compose build --pull
docker compose run --rm app php artisan migrate --force
docker compose up -d --remove-orphans
```

## Tính năng quản trị tùy chọn

phpMyAdmin và monitoring không chạy mặc định, chỉ bind localhost:

```bash
docker compose --profile tools up -d phpmyadmin
docker compose --profile monitoring up -d
```

Nên truy cập qua SSH tunnel, không publish trực tiếp ra Internet.

## Backup và rollback

Trước mỗi migration, backup MySQL ra nơi nằm ngoàn host/container. Giữ lại image tag/commit trước đó để rollback code. Migration database chỉ rollback sau khi đã xác minh tương thích dữ liệu.

## Kiểm tra sau triển khai

- `/up` trả HTTP 200.
- Trang nghiệp vụ yêu cầu HTTP Basic Auth; secret sai trả 401.
- Cookie có `HttpOnly`, `SameSite=Lax`, và `Secure` khi dùng HTTPS.
- Cổng MySQL, PHP-FPM, Loki và cAdvisor không hiển thị trên interface public.
- `APP_DEBUG=false`; log không lộ secret hay stack trace cho người dùng.
