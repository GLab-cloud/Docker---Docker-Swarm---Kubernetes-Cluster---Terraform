# Docker network inspection

Command used:

```sh
docker network inspect $(docker network ls -q)
```

## Network topology

```text
+------------------------------ Docker host -------------------------------+
|                                                                          |
|  bridge (bridge; docker0)                                                 |
|    subnet: 172.17.0.0/16   gateway: 172.17.0.1   containers: none         |
|                                                                          |
|  mynetwork (bridge)                                                       |
|    subnet: 172.18.0.0/16   gateway: 172.18.0.1   containers: none         |
|                                                                          |
|  www-net (bridge)                                                         |
|    subnet: 172.19.0.0/16   gateway: 172.19.0.1   containers: none         |
|                                                                          |
|  host (host driver; no attached containers)                               |
|  none (null driver; no attached containers)                               |
+--------------------------------------------------------------------------+
```

This snapshot shows five networks, with no containers attached to any of them.
Addresses and network IDs may differ in other Docker environments.

## Inspection output

```json
[
    {
        "Name": "bridge",
        "Id": "c23a2fe97361ea14c7cf948ad7ec3a60272e710e6e4eb03290b9854924254289",
        "Created": "2026-11-08T09:19:46.778117164Z",
        "Scope": "local",
        "Driver": "bridge",
        "EnableIPv4": true,
        "EnableIPv6": false,
        "IPAM": {
            "Driver": "default",
            "Options": null,
            "Config": [
                {
                    "Subnet": "172.17.0.0/16",
                    "Gateway": "172.17.0.1"
                }
            ]
        },
        "Internal": false,
        "Attachable": false,
        "Ingress": false,
        "ConfigFrom": {
            "Network": ""
        },
        "ConfigOnly": false,
        "Options": {
            "com.docker.network.bridge.default_bridge": "true",
            "com.docker.network.bridge.enable_icc": "true",
            "com.docker.network.bridge.enable_ip_masquerade": "true",
            "com.docker.network.bridge.host_binding_ipv4": "0.0.0.0",
            "com.docker.network.bridge.name": "docker0",
            "com.docker.network.driver.mtu": "1500"
        },
        "Labels": {},
        "Containers": {},
        "Status": {
            "IPAM": {
                "Subnets": {
                    "172.17.0.0/16": {
                        "IPsInUse": 3,
                        "DynamicIPsAvailable": 65533
                    }
                }
            }
        }
    },
    {
        "Name": "host",
        "Id": "271d58c03879738b8d05bab3e0eb40bcdea4cf76aec3c33b41801461415e6416",
        "Created": "2026-10-25T05:45:20.594661199Z",
        "Scope": "local",
        "Driver": "host",
        "EnableIPv4": true,
        "EnableIPv6": false,
        "IPAM": {
            "Driver": "default",
            "Options": null,
            "Config": null
        },
        "Internal": false,
        "Attachable": false,
        "Ingress": false,
        "ConfigFrom": {
            "Network": ""
        },
        "ConfigOnly": false,
        "Options": {},
        "Labels": {},
        "Containers": {},
        "Status": {
            "IPAM": {}
        }
    },
    {
        "Name": "mynetwork",
        "Id": "860b47c14b3c7c3ba13a23e5d98e2cb244a956b02384e89a5919eb71ba901e9e",
        "Created": "2026-11-05T03:28:46.62674265Z",
        "Scope": "local",
        "Driver": "bridge",
        "EnableIPv4": true,
        "EnableIPv6": false,
        "IPAM": {
            "Driver": "default",
            "Options": {},
            "Config": [
                {
                    "Subnet": "172.18.0.0/16",
                    "Gateway": "172.18.0.1"
                }
            ]
        },
        "Internal": false,
        "Attachable": false,
        "Ingress": false,
        "ConfigFrom": {
            "Network": ""
        },
        "ConfigOnly": false,
        "Options": {},
        "Labels": {},
        "Containers": {},
        "Status": {
            "IPAM": {
                "Subnets": {
                    "172.18.0.0/16": {
                        "IPsInUse": 3,
                        "DynamicIPsAvailable": 65533
                    }
                }
            }
        }
    },
    {
        "Name": "none",
        "Id": "142cfb068669e16bfe22a1c6f281dd79463eea2c680bc1e50911a4b0bde77563",
        "Created": "2026-10-25T05:45:20.589786525Z",
        "Scope": "local",
        "Driver": "null",
        "EnableIPv4": true,
        "EnableIPv6": false,
        "IPAM": {
            "Driver": "default",
            "Options": null,
            "Config": null
        },
        "Internal": false,
        "Attachable": false,
        "Ingress": false,
        "ConfigFrom": {
            "Network": ""
        },
        "ConfigOnly": false,
        "Options": {},
        "Labels": {},
        "Containers": {},
        "Status": {
            "IPAM": {}
        }
    },
    {
        "Name": "www-net",
        "Id": "af8a994d32433847228886263beb2bae6122e4164f8ed9daa231e5094efa31b5",
        "Created": "2026-11-06T05:51:39.289722365Z",
        "Scope": "local",
        "Driver": "bridge",
        "EnableIPv4": true,
        "EnableIPv6": false,
        "IPAM": {
            "Driver": "default",
            "Options": {},
            "Config": [
                {
                    "Subnet": "172.19.0.0/16",
                    "Gateway": "172.19.0.1"
                }
            ]
        },
        "Internal": false,
        "Attachable": false,
        "Ingress": false,
        "ConfigFrom": {
            "Network": ""
        },
        "ConfigOnly": false,
        "Options": {},
        "Labels": {},
        "Containers": {},
        "Status": {
            "IPAM": {
                "Subnets": {
                    "172.19.0.0/16": {
                        "IPsInUse": 3,
                        "DynamicIPsAvailable": 65533
                    }
                }
            }
        }
    }
]
```
