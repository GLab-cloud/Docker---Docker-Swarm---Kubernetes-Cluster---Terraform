# Docker network inspection

Command used:

```sh
docker network inspect $(docker network ls -q)
```

## Network topology

```text
+-------------------------------- Docker host --------------------------------+
|                                                                            |
|  bridge (bridge driver; docker0)       mynetwork (bridge driver)           |
|  172.17.0.0/16                         172.18.0.0/16                        |
|  gateway: 172.17.0.1                   gateway: 172.18.0.1                  |
|  +-----------------------------+       +-----------------------------+     |
|  | Container1  172.17.0.2      |       | Container4  172.18.0.2      |     |
|  | Container2  172.17.0.3      |       +-----------------------------+     |
|  | Container3  172.17.0.4      |                                           |
|  +-----------------------------+                                           |
|                                                                            |
|  host (host driver)                    none (null driver)                  |
|  No attached containers                No attached containers              |
+----------------------------------------------------------------------------+
```

The `host` and `none` networks had no attached containers in this inspection.

Output:

```json
[
    {
        "Name": "bridge",
        "Id": "dcbab8f13f67d8b11d3728f51e077876ae00b57dc1630e8184e83e4dabfb33e8",
        "Created": "2026-11-05T03:24:45.670155775Z",
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
            "0ae5aa9cc50ac40fd2d028ac007588a7687e03500322fcc5a0707452d46c1b8d": {
                "Name": "Container1",
                "EndpointID": "dc6e6531fb8fffa798a8792dd9adac8bda3c71bd48c38ac39a21a192f6b1f34f",
                "MacAddress": "d6:ad:a8:4b:ad:40",
                "IPv4Address": "172.17.0.2/16",
                "IPv6Address": ""
            },
            "219af539340b6c086913afb245ad2d54eaadada8d6e8d7c3fa234a8dd3da16b2": {
                "Name": "Container3",
                "EndpointID": "008657f315162392ebbbb70b802b1bbda2722424cff3578844484e53403f4f54",
                "MacAddress": "d2:e8:1d:b1:91:26",
                "IPv4Address": "172.17.0.4/16",
                "IPv6Address": ""
            },
            "391640018d00e04d8f15fdbd763485d1b8b5a465fc7288f456cfd59e300eb507": {
                "Name": "Container2",
                "EndpointID": "187784444c0fa4172756e8dd474503125eea31f5eb793bc8601ee4667b08cd17",
                "MacAddress": "9e:52:bd:c3:79:8d",
                "IPv4Address": "172.17.0.3/16",
                "IPv6Address": ""
            }
        },
        "Status": {
            "IPAM": {
                "Subnets": {
                    "172.17.0.0/16": {
                        "IPsInUse": 6,
                        "DynamicIPsAvailable": 65530
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
        "Containers": {
            "6a7001fadd66c784cc5fef2c85628e97d7f83ac827437783a8a526baf94f07d0": {
                "Name": "Container4",
                "EndpointID": "6a5da363e5b206c98ba9df98b49752071833661f750694f0c7bd9b3875447b8c",
                "MacAddress": "fa:83:2d:9e:1b:fa",
                "IPv4Address": "172.18.0.2/16",
                "IPv6Address": ""
            }
        },
        "Status": {
            "IPAM": {
                "Subnets": {
                    "172.18.0.0/16": {
                        "IPsInUse": 4,
                        "DynamicIPsAvailable": 65532
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
    }
]
```
