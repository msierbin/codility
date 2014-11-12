import java.util.Set;
import java.util.HashSet;

class Solution {

  /* The first covering prefix of array A is the smallest integer P such that
   * 0≤P<N and such that every value that occurs in array A also occurs in 
   * sequence A[0], A[1], ..., A[P].
   * 
   * For example, the first covering prefix of the following 5−element array A:
   * A[0] = 2  
   * A[1] = 2  
   * A[2] = 1
   * A[3] = 0  
   * A[4] = 1
   * is 3, because sequence [ A[0], A[1], A[2], A[3] ] equal to [2, 2, 1, 0], 
   * contains all values that occur in array A. 
   */
  public int solution(int[] A) {
    final Set<Integer> elementsToFound = getAllDistinctElementsIn(A);
             
    for (int P = 0; P < A.length; P++) {
      elementsToFound.remove(A[P]);
      if (elementsToFound.isEmpty())
        return P; // first covering prefix
    }
    return -1;
  }
    
  private static final Set<Integer> getAllDistinctElementsIn(int[] A) {
    final Set<Integer> allElements = new HashSet<Integer>();
        
    for (int element : A)
      allElements.add(element);
            
    return allElements;
  }
}
