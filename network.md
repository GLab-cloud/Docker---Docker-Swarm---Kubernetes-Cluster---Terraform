# Docker network inspection

## Current Compose gateway

The current Compose stack uses the `mycode_www-net` bridge network (logical
Compose name `www-net`) with gateway `172.20.0.1`. The three application
containers are attached to this network:

```text
mycode_www-net (172.20.0.0/16; gateway 172.20.0.1)
  c-mysql  172.20.0.2   published port 3306
  c-php    172.20.0.3   published port 9000; PHP-FPM listens on all interfaces
  c-httpd  172.20.0.4   host ports 9999->80 and 443->443

Apache -> 172.20.0.1:9000 -> PHP-FPM
WordPress -> 172.20.0.1:3306 -> MySQL
```

Compose pins the subnet and gateway in `mycode/docker-compose.yaml`. The
published ports are required for these gateway routes.

## Earlier Docker network inspection

Command used:

```sh
docker network inspect $(docker network ls -q)
```

The topology and inspection output below are an earlier snapshot (gateway
`172.19.0.1`), retained for historical reference; they do not describe the
current Compose network.

### Earlier network topology

```text
+------------------------------ Docker host -------------------------------+
|                                                                          |
|  bridge (bridge; docker0)                                                 |
|    subnet: 172.17.0.0/16   gateway: 172.17.0.1                          |
|    +----------------------+                                               |
|    | c-mysql  172.17.0.2  |                                               |
|    +----------------------+                                               |
|                                                                          |
|  mynetwork (bridge)                                                       |
|    subnet: 172.18.0.0/16   gateway: 172.18.0.1   no attached containers   |
|                                                                          |
|  www-net (bridge)                                                         |
|    subnet: 172.19.0.0/16   gateway: 172.19.0.1                          |
|    +----------------------+   +------------------------+                 |
|    | c-php   172.19.0.2   |   | c-httpd  172.19.0.3   |                 |
|    +----------------------+   +------------------------+                 |
|    | c-mysql 172.19.0.4   |                                               |
|    +----------------------+                                               |
|                                                                          |
|  host (host driver; no attached containers)                               |
|  none (null driver; no attached containers)                               |
+--------------------------------------------------------------------------+
```

This snapshot shows five networks. `c-mysql` is attached to both `bridge` and
`www-net`; `c-php` and `c-httpd` are also attached to `www-net`. The other
networks have no attached containers. Addresses and network IDs may differ in
other Docker environments.

## Inspection output

```json
[
    {
        "Name": "bridge",
        "Id": "71efcbd41c2a377b0adb118665a6abe2c9ab78557443c2e5d6b80655da310200",
        "Created": "2026-11-09T08:02:08.606621678Z",
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
        "Containers": {
            "3285a5c3dcc33f1f10fdf611a5cbc363774023c814761baa01603383f396df6e": {
                "Name": "c-mysql",
                "EndpointID": "881705b2562faa81125965923984eb40c4d1868988d7cff31fb232f1661f5afd",
                "MacAddress": "fa:4c:fc:7a:35:ae",
                "IPv4Address": "172.17.0.2/16",
                "IPv6Address": ""
            }
        },
        "Status": {
            "IPAM": {
                "Subnets": {
                    "172.17.0.0/16": {
                        "IPsInUse": 4,
                        "DynamicIPsAvailable": 65532
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
        "Containers": {
            "3285a5c3dcc33f1f10fdf611a5cbc363774023c814761baa01603383f396df6e": {
                "Name": "c-mysql",
                "EndpointID": "5b2a0927215a71b412b64a2b3146e0dc05b6904091e161e30210bf9dece827be",
                "MacAddress": "1e:58:b3:f4:84:f6",
                "IPv4Address": "172.19.0.4/16",
                "IPv6Address": ""
            },
            "d71601b9417e665c936fda1f70c4c48b33f5655759c789e3b3e2ae42663d4d88": {
                "Name": "c-php",
                "EndpointID": "82e06ef724fa0e69b05c9c747e160f7e8aa231003dbdc330cf8225197b3b1a52",
                "MacAddress": "12:53:a2:f8:11:65",
                "IPv4Address": "172.19.0.2/16",
                "IPv6Address": ""
            },
            "dade4bc45d436af6e299ae95808a7fa5e0eae2716d003ad7b229a84373064e73": {
                "Name": "c-httpd",
                "EndpointID": "e44c9244d3c9749efe634fd181784f0b00600edc9eab1c02341f3eea27c98e52",
                "MacAddress": "e6:c2:dd:af:97:45",
                "IPv4Address": "172.19.0.3/16",
                "IPv6Address": ""
            }
        },
        "Status": {
            "IPAM": {
                "Subnets": {
                    "172.19.0.0/16": {
                        "IPsInUse": 6,
                        "DynamicIPsAvailable": 65530
                    }
                }
            }
        }
    }
]
```
