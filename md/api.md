### 获取青年大学习列表
此接口获取的API并非完整版的青年大学习列表，且无法保证数据是否准确。

---
#### 请求
##### 请求方式：GET/POST

| 参数 | 默认 | 必填 | 说明 |
| -- | -- | -- | -- |
| page | 1 | 否 | 页数 |

---

#### 响应
##### 响应类型：JSON

| 参数 | 数据类型 | 说明 |
| -- | -- | -- |
| code | int | 状态码 |
| msg | srting | 响应信息 |
| data | object | 数据列表 |

---

| code状态码 | 说明 |
| -- | -- | 
| -3 | API已关闭 |
| -1 | 配置文件错误 |
| 0 | 成功 |
| 1 | 缓存的数据(已弃用) |

---

| data数据(code=0/1) | 数据类型 | 说明 | 
| -- | -- | -- | 
| title | string | 标题 |
| title2 | string | 标题2 |
| info | string | 信息来源 |
| time | string | 发布时间 |
| image | string | 宣传图链接 |
| url |  string | 大学习链接 |
| editor | string | editor |
| author | string | author |
| source | string | 数据来源 |

---

| data数据(code=-1) | 数据类型 | 说明 |
| -- | -- | -- |
| array | string | 出错的参数 |