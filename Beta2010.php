/* Given an array A of N integers, we draw N discs in a 2D plane such that 
 * the I-th disc is  *centered on (0,I) and has a radius of A[I]. We say 
 * that the J-th disc and K-th disc intersect if  *J ? K and J-th and K-th 
 * discs have at least one common point.
 * Write a function: int solution(int A[]);
 * that, given an array A describing N discs as explained above, returns 
 * the number of pairs of intersecting discs. For example, given N=6 and:
 * A[0] = 1  A[1] = 5  A[2] = 2 
 * A[3] = 1  A[4] = 4  A[5] = 0  
 * intersecting discs appear in eleven pairs of elements:
 * 0 and 1,
 * 0 and 2,
 * 0 and 4,
 * 1 and 2,
 * 1 and 3,
 * 1 and 4,
 * 1 and 5,
 * 2 and 3,
 * 2 and 4,
 * 3 and 4,
 * 4 and 5.
 * so the function should return 11.
 * The function should return -1 if the number of intersecting pairs 
 * exceeds 10,000,000.function 
 */
solution($A) {
  $result = 0;
  $len = count($A);
    
  $starts = array_fill(0, $len, 0);
  $ends   = array_fill(0, $len, 0);
    
  for ($i = 0; $i < $len; $i++) {
    $diskStart = $i - $A[$i];
    $diskEnd   = $i + $A[$i];
      
    $starts[max($diskStart,        0)]++;
    $ends  [min($diskEnd  , $len - 1)]++;
  }
    
  $currentDisks = 0;
  for ($i = 0; $i < $len; $i++) {
    if ($starts[$i] > 0){
      $intersectionsWithCurrentDiscs    = $starts[$i] * $currentDisks;
      $intersectionsWithinStartingDiscs = $starts[$i] * ($starts[$i] - 1) / 2;
      $result += $intersectionsWithCurrentDiscs + $intersectionsWithinStartingDiscs;
      if ($result > 10 * 1000000) {
        return -1;
      }
      $currentDisks += $starts[$i];
    }
    $currentDisks -= $ends[$i];
  }
  return $result;
}