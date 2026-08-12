FROM node:22-alpine AS builder

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .

# Browser calls same-origin /api through the gateway nginx
ARG VITE_API_URL=/api
ENV VITE_API_URL=$VITE_API_URL

RUN npm run build


# Seed the shared client_dist volume mounted at /output
FROM alpine:3.20

COPY --from=builder /app/dist /dist

CMD ["sh", "-c", "rm -rf /output/* /output/.[!.]* 2>/dev/null; cp -a /dist/. /output/ && echo 'client dist ready'"]
