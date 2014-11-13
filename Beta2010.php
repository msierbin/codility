function solution($A) {
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