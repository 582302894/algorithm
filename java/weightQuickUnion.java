import edu.StdOut;


//加权连通分量
class WeightQuickUnion {
    public static void main(String[] args) {
        int[][] points=new int[][]{{4,3},{3,8},{6,5},{9,4},{2,1},{5,0},{7,2},{6,1}};
        QuickUnion quickUnion=new QuickUnion(10);
        // quickUnion.show();
        for (int i = 0; i < points.length; i++) {
            if(!quickUnion.connected(points[i][0], points[i][1])){
                quickUnion.union(points[i][0], points[i][1]);
            } 
        }
        quickUnion.show();
    }
}


class QuickUnion {
    private int[] id;
    private int[] sz;
    // private int count;

    public QuickUnion(int N) {
        // count = N;
        id = new int[N];
        sz = new int[N];
        for (int i = 0; i < N; i++) {
            id[i] = i;
            sz[i] = 1;
        }
    }

    public boolean connected(int q,int p){
        return find(q)==find(p);
    }

    public int find(int q) {
        while (q != id[q]) {
            q = id[q];
        }
        return q;
    }
    
    public void union(int q, int p) {
        int i = find(q);
        int j = find(p);
        if (i == j) {
            return;
        }
        if ( sz[i] < sz[j]) {
            id[i] = j;
            sz[j] += sz[i];
        } else {
            id[j] = i;
            sz[i] += sz[j];
        }
    }

    public void show(){
        for (int i = 0; i < id.length; i++) {
            StdOut.println(id[i]);
        }
    }
}