# Docker `bridge` network

Result summary from `docker network inspect bridge` (captured 2026-10-31):

```text
+---------------------------- Docker host -----------------------------+
|                                                                      |
|  +------------------------+                                          |
|  | C1         172.17.0.2   |                                          |
|  | C2         172.17.0.3   |                                          |
|  | Container2 172.17.0.4   |                                          |
|  | Container1 172.17.0.5   |                                          |
|  +------------+-----------+                                          |
|               |                                                      |
|  +------------+---------------------------------------------------+  |
|  | network: bridge (docker0)            172.17.0.0/16             |  |
|  +----------------------------------------------+-----------------+  |
|                                                 |                    |
|                                            +----+-----+              |
|                                            | NIC      |              |
|                                            |172.17.0.1|              |
|                                            |localhost |              |
|                                            +----------+              |
+----------------------------------------------------------------------+
```

## Network details

| Property | Value |
|---|---|
| Name | `bridge` |
| Network ID | `09503fe96b8e75bef7bb4d206ff5aa166d068db8bafb50e9a538875233afc349` |
| Created | `2026-10-31T09:02:18.14463279Z` |
| Driver / scope | `bridge` / `local` |
| IPv4 / IPv6 | Enabled / disabled |
| Subnet | `172.17.0.0/16` |
| Gateway | `172.17.0.1` |
| Bridge interface | `docker0` |
| Internal / attachable / ingress | `false` / `false` / `false` |
| MTU | `1500` |
| Inter-container communication | Enabled |
| IP masquerading | Enabled |
| Default host binding IPv4 | `0.0.0.0` |

## Attached containers

| Container | Container ID (short) | IPv4 address | MAC address |
|---|---|---|---|
| `C1` | `f47423c73fad` | `172.17.0.2/16` | `46:aa:7a:b8:13:e6` |
| `C2` | `36c85528c84a` | `172.17.0.3/16` | `76:a7:b2:d0:c7:52` |
| `Container2` | `391640018d00` | `172.17.0.4/16` | `c6:65:35:8a:18:a2` |
| `Container1` | `0ae5aa9cc50a` | `172.17.0.5/16` | `1e:ef:45:9f:3d:4a` |

## IPAM status

| Subnet | IPs in use | Dynamic IPs available |
|---|---:|---:|
| `172.17.0.0/16` | 7 | 65,529 |
