### 单源最路径
>Dijkstra算法 O(n^2) 邻接矩阵

```
map = [
    [0, 1, 12, MAX, MAX, MAX],
    [MAX, 0, 9, 3, MAX, MAX],
    [MAX, MAX, 0, MAX, 5, MAX],
    [MAX, MAX, 4, 0, 13, 15],
    [MAX, MAX, MAX, MAX, 0, 4],
    [MAX, MAX, MAX, MAX, MAX, 0],
];
```


##### round 1
```
book[1]=1;
dis=[0, 1, 12, MAX, MAX, MAX]

2,3,4,5,6中  MIN(dis)=1;
next=2;
```
##### round 2
```
book[2]=1;
dis=MIN(dis,dis[2]+map[2][n])=[0,1,10,4,MAX,MAX];

3,4,5,6中    MIN(dis)=4;
next=4;
```
##### round 3
```
book[4]=1;
dis=MIN(dis[4],dis+map[4][n])=[0,1,8,4,17,19];

3,5,6中    MIN(dis)=8;
next=3;
```
##### round 4
```
book[3]=1;
dis=MIN(dis[3],dis+map[3][n])=[0,1,8,4,13,19];

5,6中    MIN(dis)=13;
next=5;
```
##### round 5
```
book[5]=1;
dis=MIN(dis[5],dis+map[5][n])=[0,1,8,4,13,17];

next=6
```
##### round 6
```
book[6]=1;
dis=MIN(dis[6],dis+map[6][n])=[0,1,8,4,13,17];

end
```