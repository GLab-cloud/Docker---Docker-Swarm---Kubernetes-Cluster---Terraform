# Docker, Docker Swarm, Kubernetes, and Terraform

This repository contains hands-on Docker notes and examples, with room for
Docker Swarm, Kubernetes, and Terraform material.

## Current contents

The repository includes:

- [`Docker.txt`](./Docker.txt), a command log covering images, containers,
  volumes, bridge networking, and PHP/Apache examples.
- [`network.md`](./network.md), a Docker network inspection snapshot and
  topology diagram.
- `data/`, sample files used for volume-mount examples.
- `mycode/`, sample web content and an Apache configuration.
- `myimage.tar`, a saved Docker image used by the image save/load examples.
- `.devcontainer/`, the development-container configuration.
- `.gitignore`, rules for local Docker data, Kubernetes credentials,
  Terraform state and variable files, environment files, and build artifacts.

There are no Dockerfiles, Compose files, Swarm stacks, Kubernetes manifests,
Helm charts, or Terraform configurations in the repository yet.

## Docker network example

The latest documented inspection shows four Docker networks: the default
`bridge`, `host`, `mynetwork`, and `none`. `Container1` through `Container5`
are attached to the default bridge network; `Container4` and `Container5` are
also attached to `mynetwork`. See [`network.md`](./network.md) for the network
addresses and the full inspection output.

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
## Why isolate the PHP-FPM Container?

- Microservices Architecture: The Web Server (Apache/Nginx) handles incoming HTTP requests and serves static files (HTML, CSS, JS, images). When it encounters a .php file, it forwards (proxies) the request to the PHP-FPM container for processing.
- Performance Optimization: PHP-FPM (FastCGI Process Manager) excels at managing PHP processes. It handles high traffic much better than the old-school method of embedding PHP directly inside Apache (mod_php).
- Scalability: If your application slows down due to heavy PHP logic, you can easily scale up by spinning up multiple PHP containers to share the load, without needing to duplicate the Apache web server.