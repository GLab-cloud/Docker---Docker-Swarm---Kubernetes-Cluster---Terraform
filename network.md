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
|  | Container2  172.17.0.3      |       | Container5  172.18.0.3      |     |
|  | Container3  172.17.0.4      |       +-----------------------------+     |
|  | Container4  172.17.0.5      |                                           |
|  | Container5  172.17.0.6      |                                           |
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
        "Id": "e23694b71ba3515bdc1e27b043aee5ee09e5dbeb1a0a6b3a92a0307e446c7363",
        "Created": "2026-11-05T05:48:52.474935895Z",
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
            "074f1afb2b0c5f823eaf6009c28d55a4ee425ac7ab814470479044f386eb4563": {
                "Name": "Container5",
                "EndpointID": "b709aebc4bffcfc44433b8d3ce3c63c155f09260036dbbd5b2a7c5fb4b534302",
                "MacAddress": "26:8a:71:0b:fa:76",
                "IPv4Address": "172.17.0.6/16",
                "IPv6Address": ""
            },
            "0ae5aa9cc50ac40fd2d028ac007588a7687e03500322fcc5a0707452d46c1b8d": {
                "Name": "Container1",
                "EndpointID": "98adaa4fa709d9a9833a5f9af92a444763de4dd3571ea12fcb83a51eba352911",
                "MacAddress": "de:92:e6:89:f4:53",
                "IPv4Address": "172.17.0.2/16",
                "IPv6Address": ""
            },
            "219af539340b6c086913afb245ad2d54eaadada8d6e8d7c3fa234a8dd3da16b2": {
                "Name": "Container3",
                "EndpointID": "61ffc1eb6b2c66b8d306d200506221597a7c6c403c5377600811b5d9d93db475",
                "MacAddress": "82:4f:34:a0:6a:4e",
                "IPv4Address": "172.17.0.4/16",
                "IPv6Address": ""
            },
            "391640018d00e04d8f15fdbd763485d1b8b5a465fc7288f456cfd59e300eb507": {
                "Name": "Container2",
                "EndpointID": "e3875604013988a81272b36b99068b01ff6103a02523368b9c00742bd3aadd77",
                "MacAddress": "72:34:f7:10:72:9b",
                "IPv4Address": "172.17.0.3/16",
                "IPv6Address": ""
            },
            "6a7001fadd66c784cc5fef2c85628e97d7f83ac827437783a8a526baf94f07d0": {
                "Name": "Container4",
                "EndpointID": "905f1254b25cda6740e3bb535039bb1c03043b124791a9ab4695dddcd16756c7",
                "MacAddress": "be:02:84:c0:2d:33",
                "IPv4Address": "172.17.0.5/16",
                "IPv6Address": ""
            }
        },
        "Status": {
            "IPAM": {
                "Subnets": {
                    "172.17.0.0/16": {
                        "IPsInUse": 8,
                        "DynamicIPsAvailable": 65528
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
            "074f1afb2b0c5f823eaf6009c28d55a4ee425ac7ab814470479044f386eb4563": {
                "Name": "Container5",
                "EndpointID": "01da879f4d9384c1ed281eb46e270890c1343906365605c6cfaa009887ba385a",
                "MacAddress": "da:e3:f7:62:65:5f",
                "IPv4Address": "172.18.0.3/16",
                "IPv6Address": ""
            },
            "6a7001fadd66c784cc5fef2c85628e97d7f83ac827437783a8a526baf94f07d0": {
                "Name": "Container4",
                "EndpointID": "c0fb1fd7f4bb69f92b51fe12de2406bb06a15f71487dffe1dc56a94b5a723e39",
                "MacAddress": "c2:63:20:5e:0a:7e",
                "IPv4Address": "172.18.0.2/16",
                "IPv6Address": ""
            }
        },
        "Status": {
            "IPAM": {
                "Subnets": {
                    "172.18.0.0/16": {
                        "IPsInUse": 5,
                        "DynamicIPsAvailable": 65531
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
