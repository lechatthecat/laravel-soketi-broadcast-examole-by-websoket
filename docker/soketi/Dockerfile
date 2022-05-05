FROM node:14-alpine
LABEL maintainer "le chat the cat"

ENV PYTHONUNBUFFERED=1

RUN apk add --no-cache --update git python3 gcompat openssh supervisor wget && \
    apk add --virtual build-dependencies build-base gcc && \
    ln -sf python3 /usr/bin/python && \
    python3 -m ensurepip && \
    pip3 install --no-cache --upgrade pip setuptools && \
    apk add --update-cache --no-cache nodejs npm && \
    npm config set cache /tmp --global && \
    npm install -g @soketi/soketi && \
    apk --purge del build-dependencies build-base gcc && \
    rm -rf /tmp/* /var/cache/*

#ENTRYPOINT ["/bin/ash", "-c"]
