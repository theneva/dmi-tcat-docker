#!/bin/bash
while true; do
  php $tcat_home/capture/stream/controller.php || true
  sleep 1m
done
