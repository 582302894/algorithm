### 单源最路径
>Bellman Ford算法 O(NM) 邻接矩阵 解决负权边

```
u   v  w
[2, 3, 2]
[1, 2, -3]
[1, 5, 5]
[4, 5, 2]
[3, 4, 3]
u 边的入顶点
v 边的出顶点
w 边的权重
start
next
```

```
dis[v[i]]=MIN(dis[v[i]],dis[u[i]]+w[i])
i:1->5
```


##### round 1
```
dis=[0, MAX, MAX, MAX, MAX]
```
##### round 2
```
dis=[0, -3, MAX, MAX, 5]
```
##### round 3
```
dis=[0, -3, -1, 2, 5]
```
##### round 4
```
dis=[0, -3, -1, 2, 4]
```
##### round 5
```
dis=[0, -3, -1, 2, 4]s
```
