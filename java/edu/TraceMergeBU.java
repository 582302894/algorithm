/******************************************************************************
 *  Compilation:  javac TraceMergeBU.java
 *  Execution:    java  TraceMergeBU input
 *  Dependencies: StdDraw.java
 *
 *  Mergesort the sequence of strings specified as the command-line
 *  arguments and show the detailed trace.
 *
 *  % java TraceMergeBU MERGESORTEXAMPLE
 *
 ******************************************************************************/

import java.awt.Font;

public class TraceMergeBU {

    private static void merge(String[] a, String[] aux, int lo, int mid, int hi) {

        // copy to aux[]
        for (int k = lo; k <= hi; k++) {
            aux[k] = a[k]; 
        }

        // merge back to a[]
        int i = lo, j = mid+1;
        for (int k = lo; k <= hi; k++) {
            if      (i > mid)              a[k] = aux[j++];
            else if (j > hi)               a[k] = aux[i++];
            else if (less(aux[j], aux[i])) a[k] = aux[j++];
            else                           a[k] = aux[i++];
        }

    }

    // bottom-up mergesort
    public static void sort(String[] a) {
        int line = 0;
        int n = a.length;
        String[] aux = new String[n];
        for (int k = 1; k < n; k = k+k) {
            for (int i = 0; i < n-k; i += k+k) {
                int lo = i;
                int mid  = i + k - 1;
                int hi = Math.min(i+k+k-1, n-1);
                merge(a, aux, lo, mid, hi);
                draw(a, line, lo, mid, hi);
                line++;
            }
        }
    }

    // is v < w ?
    private static boolean less(String v, String w) {
        return v.compareTo(w) < 0;
    }


    // draw the contents of the array, with a[lo] to a[hi] in black
    private static void draw(String[] a, int line, int lo, int m, int hi) {
        StdDraw.setPenColor(StdDraw.BLACK);
        StdDraw.text(-2.50, line, m  + "");
        StdDraw.setPenColor(StdDraw.BOOK_RED);
        StdDraw.text(-3.75, line, lo + "");
        StdDraw.text(-1.25, line, hi + "");
        for (int i = 0; i < a.length; i++) {
            if (i >= lo && i <= hi) StdDraw.setPenColor(StdDraw.BLACK);
            else                    StdDraw.setPenColor(StdDraw.LIGHT_GRAY);
            StdDraw.text(i, line, a[i]);
        }
    }

    // display header
    private static void header(String[] a) {
        int n = a.length;
        StdDraw.setPenColor(StdDraw.BLACK);
        StdDraw.text(n/2.0, -3, "a[ ]");       
        for (int i = 0; i < n; i++)
            StdDraw.text(i, -2, i + "");       
        StdDraw.text(-3.75, -2, "lo");
        StdDraw.text(-2.50, -2, "m");
        StdDraw.text(-1.25, -2, "hi");
        StdDraw.setPenColor(StdDraw.BOOK_RED);
        StdDraw.line(-4, -1.65, n - 0.5, -1.65);
        StdDraw.setPenColor(StdDraw.BLACK);
        for (int i = 0; i < n; i++)
            StdDraw.text(i, -1, a[i]);
    }

    // display footer
    private static void footer(String[] a) {
        int n = a.length;
        StdDraw.setPenColor(StdDraw.BLACK);
        for (int i = 0; i < n; i++)
            StdDraw.text(i, n-1, a[i]);
    }


    // test client
    public static void main(String[] args) {
        // parse command-line argument as an array of 1-character strings
        String s = args[0];
        int n = s.length();
        String[] a = new String[n];
        for (int i = 0; i < n; i++)
            a[i] = s.substring(i, i+1);

        // set canvas size
        StdDraw.setCanvasSize(30*(n+3), 30*(n+3));
        StdDraw.setXscale(-4, n+1);
        StdDraw.setYscale(n+1, -4);
        StdDraw.setFont(new Font("SansSerif", Font.PLAIN, 13));

        // display the header
        header(a);

        // sort the array and display trace
        sort(a);

        // display the footer
        footer(a);
    }

}
