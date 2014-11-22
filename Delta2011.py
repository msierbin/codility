def solution(A):
    if (A == []): return 0
    
    A = list(abs(x) for x in A)

    SUM = sum(A)
    MAX = max(A)

    # lookup table where C[i] is the COUNT of i element in A
    C = [0] * (MAX + 1)
    for i in xrange(len(A)):
        C[A[i]] += 1

    # Lookup table R where i is the REACHABLE SUM for already analyzed
    # elements and R[i] means: 
    # == -1   element is unreachable sum
    # ==  0   element is reachable sum
    # x>  0   element is reachable sum, and would be increased x times more (because of multiple values in A)
    R = [-1] * (SUM + 1)
    R[0] = 0
    
    possibleValuesInA = xrange(1, MAX + 1)
    for v in possibleValuesInA:
        numOfOccurences = C[v]
        if numOfOccurences > 0:
            for sum_i in xrange(SUM):
                isSumReachable = R[sum_i] >= 0
                if isSumReachable:
                    R[sum_i] = numOfOccurences
                # is it possible to be reached by adding v?
                elif (sum_i - v >= 0 and R[sum_i - v] > 0):
                    R[sum_i] = R[sum_i - v] - 1

    for i in xrange(SUM / 2, -1 , -1):
        if R[i] >= 0:
            return SUM - 2 * i

    return SUM
