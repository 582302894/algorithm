import edu.StdOut;

class Ex151 {
    public static void main(String[] args) {
        String opS = new String("9-0 3-4 5-8 7-2 2-1 5-7 0-3 4-2");
        String[] ops = opS.split(" ");
        int[][] options = new int[ops.length][2];
        for (int i = 0; i < ops.length; i++) {
            String[] temp = ops[i].split("-");
            options[i][0] = Integer.parseInt(temp[0]);
            options[i][1] = Integer.parseInt(temp[1]);
        }

        QuickUnionUF quickUnion = new QuickUnionUF(10);
        for (int i = 0; i < options.length; i++) {
            if (quickUnion.connected(options[i][0], options[i][1])) {
                continue;
            }
            quickUnion.union(options[i][0], options[i][1]);
        }
        quickUnion.show();
    }
}

class QuickUnionUF {
    private int[] id;
    private int count;
    private int max = 1000;
    private int[] cost = new int[max];

    public QuickUnionUF(int N) {
        count = 0;
        id = new int[N];
        for (int i = 0; i < N; i++) {
            id[i] = i;
        }
    }

    public boolean connected(int q, int p) {
        return find(q) == find(p);
    }

    public int find(int q) {
        while (q != id[q]) {
            q = id[q];
            count(2);
        }
        return q;
    }

    public void union(int q, int p) {
        count++;
        int i = find(q);
        int j = find(p);
        if (i == j) {
            return;
        }
        id[q] = j;
        count(1);
    }

    public void show() {
        for (int i = 0; i < id.length; i++) {
            StdOut.println(i + " " + id[i]);
        }
        StdOut.println("count " + count);
        for (int i = 1; i < max; i++) {
            if (cost[i] == 0) {
                break;
            }
            StdOut.println(i + " " + cost[i]);
        }
    }

    public void count(int number) {
        if (count >= max) {
            return;
        }
        cost[count] += number;
    }
}