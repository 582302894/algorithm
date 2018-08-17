import edu.Bag;
import edu.Counter;
import edu.StdDraw;
import edu.StdOut;
import edu.StdRandom;

class Test {

    public static void main(String[] args) {
        Bag<Integer> bag=new Bag<Integer>();
        bag.add(1);
        bag.add(2);
        bag.add(3);
        bag.add(4);
        bag.add(5);
        bag.add(6);
        bag.add(7);
        for (int  x : bag) {
            StdOut.println(x);
        }
    }
}