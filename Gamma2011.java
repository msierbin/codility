import java.lang.Math;
import java.util.Arrays;

class Solution {
    public int solution(String S) {
        int odd = calculateOddSlices(S);
        if (odd == -1) return -1;
        int even = calculateEvenSlices(S);
        if (even == -1) return -1;
        return even + odd > 100*1000000 ? -1 : even + odd;
    }
    
    private int calculateOddSlices(String s) { return calculateSlices(s, false); }
    private int calculateEvenSlices(String s) { return calculateSlices(s, true); }
    
    private int calculateSlices(String string, boolean isEven) {
        final String s = "^" + string + "$"; // add guardians
        
        int i = 1;
        int t = 0;
        int[] P = new int[s.length()];
        
        while (i < s.length() - 1) {
            while (s.charAt(i - t - (isEven ? 0 : 1)) == s.charAt(i + 1 + t)) t++;
            P[i] = t;
            
            int k = 1;
            while (k <= t && P[i - k] != P[i] - k) { 
                P[i+k] = Math.min(P[i - k], P[i] - k);
                k++;
            }

            i += k;
            t -= k; t = Math.max(0, t);
        }
        
        int sum = 0;
        for (int a : P) sum += a;
        return sum > 100*1000000 ? -1 : sum;
    }
}
