# Docker, Docker Swarm, Kubernetes, and Terraform

This repository is intended to hold containerization, orchestration, and
infrastructure-as-code examples using Docker, Docker Swarm, Kubernetes, and
Terraform.

## Current contents

The repository is currently a starter scaffold. It contains:

- `.gitignore` rules for local Docker data, Kubernetes credentials, Terraform
  state and variable files, environment files, and build artifacts.
- This README.

There are no Dockerfiles, Compose files, Swarm stacks, Kubernetes manifests,
Helm charts, or Terraform configurations in the repository yet.

## Getting started

No deployment or provisioning commands are available yet. Add the relevant
configuration files before attempting to build containers, deploy workloads,
or provision infrastructure.

## Handling local configuration and secrets

The `.gitignore` excludes common local-only files, including Kubernetes
kubeconfig files, Terraform state and `.tfvars` files, and environment or
credential files. Keep credentials and generated infrastructure state out of
version control. Review the ignore rules before adding files that are intended
to be shared with the repository.
