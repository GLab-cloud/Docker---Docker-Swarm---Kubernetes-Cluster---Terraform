# Docker, Docker Swarm, Kubernetes, and Terraform

This repository contains hands-on Docker notes and examples, with room for
Docker Swarm, Kubernetes, and Terraform material.

## Current contents

The repository includes:

- [`Docker.txt`](./Docker.txt), a command log covering images, containers,
  volumes, bridge networking, and Apache/PHP-FPM examples.
- [`network.md`](./network.md), a Docker network inspection snapshot and
  topology diagram.
- `data/`, sample files used for volume-mount examples.
- `mycode/`, sample HTML/PHP content and an Apache configuration for the
  PHP-FPM example.
- `myimage.tar`, a saved Docker image used by the image save/load examples.
- `.devcontainer/`, the development-container configuration.
- `.gitignore`, rules for local Docker data, Kubernetes credentials,
  Terraform state and variable files, environment files, and build artifacts.

The MySQL/PHP-FPM/Apache example is defined in
[`mycode/docker-compose.yaml`](./mycode/docker-compose.yaml). The repository
does not yet include Swarm stacks, Kubernetes manifests, Helm charts, or
Terraform configurations.

## Apache and PHP-FPM example

The Compose stack runs MySQL, PHP-FPM, and Apache on the `www-net` bridge
network. In this Codespaces setup, Apache and WordPress use the bridge gateway
(`172.20.0.1`) with the published PHP-FPM and MySQL ports; PHP-FPM listens on
all container interfaces. The gateway is pinned in Compose so these routes
remain consistent when the stack is recreated. See [`Docker.txt`](./Docker.txt)
for command examples and [`mycode/`](./mycode) for the stack configuration.

## Docker network example

The current Compose network is `mycode_www-net` (the Compose logical network is
`www-net`), with gateway `172.20.0.1`. MySQL, PHP-FPM, and Apache are attached
to it; Apache reaches PHP-FPM and WordPress reaches MySQL through their
published ports on that gateway. See [`network.md`](./network.md) for the
current topology and the earlier inspection snapshot.

The network details in `network.md` are a snapshot of the Docker environment
where the command was run. Network IDs, container attachments, and addresses
may differ in another environment.

## Getting started

Review [`Docker.txt`](./Docker.txt) for the example commands. Some commands
refer to existing local containers, images, paths, or exposed development
ports, so adapt them to your environment before running them. No Swarm,
Kubernetes, or Terraform deployment configuration is included yet.

## Handling local configuration and secrets

The `.gitignore` excludes common local-only files, including Kubernetes
kubeconfig files, Terraform state and `.tfvars` files, and environment or
credential files. Keep credentials and generated infrastructure state out of
version control. Review the ignore rules before adding files that are intended
to be shared with the repository.
