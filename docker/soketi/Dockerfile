FROM quay.io/soketi/soketi:1.0-16-debian
LABEL maintainer "le chat the cat"

ENV PYTHONUNBUFFERED=1

RUN apt update && apt install -y build-essential \
    git \
    supervisor

#ENTRYPOINT ["/bin/ash", "-c"]
