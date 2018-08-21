import java.lang.Comparable;
import edu.StdOut;

class BSTF {
    public static void main(String[] args) {
        BST<String, Integer> b = new BST<String, Integer>();
        b.put("S", 0);
        b.put("E", 1);
        b.put("A", 2);
        b.put("R", 3);
        b.put("C", 4);
        b.put("H", 5);
        b.put("E", 6);
        b.put("X", 7);
        // b.show(b.root);
        b.draw();
    }
}

class BST<Key extends Comparable<Key>, Value>{
    public Node root;
    
    public class Node {
        public Key key;
        public Value value;
        public Node left, right;
        public int N;

        public Node(Key key, Value value, int N) {
            this.key = key;
            this.value = value;
            this.N = N;
        }
    }

    public int size() {
        return size(root);
    }

    private int size(Node x) {
        if (x == null) {
            return 0;
        }
        return x.N;
    }

    public Value get(Key key) {
        return get(root,key);
    }

    private Value get(Node x,Key key) {
        if (x == null) {
            return null;
        }
        int cmp = key.compareTo(x.key);
        if (cmp == 0) {
            return x.value;
        } else if (cmp < 0) {
            return get(x.left, key);
        } else {
            return get(x.right, key);
        }
    }

    public void put(Key key, Value value) {
        root = put(root, key, value);
    }

    private Node put(Node x, Key key, Value value) {
        if (x == null) {
            return new Node(key, value, 1);
        }
        int cmp = key.compareTo(x.key);
        if (cmp == 0) {
            x.value = value;
        } else if (cmp < 0) {
            x.left = put(x.left, key, value);
        } else {
            x.right = put(x.right, key, value);
        }
        x.N = size(x.left) + size(x.right) + 1;
        return x;
    }

    public void draw() {
        
    }
    
    public void show(Node x) {
        if (x == null) {
            return;
        }
        show(x.left);
        StdOut.println(x.key + " " + x.value);
        show(x.right);
    }
    
}