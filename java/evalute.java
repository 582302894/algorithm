// 两个栈存储运算符与运算表达式

import edu.Stack;
import edu.StdIn;
import edu.StdOut;

class Evalute {
    public static void main(String[] args) {
        Stack<String> ops = new Stack<String>();
        Stack<Integer> vals = new Stack<Integer>();
        String s=new String();
        while (!StdIn.isEmpty()) {
            s = StdIn.readString();
            if (s.equals("+") || s.equals("-") || s.equals("*") || s.equals("/")) {
                ops.push(s);
            } else if (s.equals("(")) {
                continue;
            } else if (s.equals(")")) {
                String op = ops.pop();
                int val = vals.pop();
                int n = vals.pop();
                if (op.equals("+")) {
                    vals.push(n + val);
                } else if (op.equals("-")) {
                    vals.push(n - val);
                } else if (op.equals("*")) {
                    vals.push(n * val);
                } else if (op.equals("/")) {
                    vals.push(n / val);
                }
            } else {
                vals.push(Integer.parseInt(s));
            }
        }
        StdOut.println(vals.pop());
        // StdOut.println(s);
    }
}