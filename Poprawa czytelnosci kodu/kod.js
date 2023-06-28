arrA.filter(x => !arrB.includes(x)).concat(arrB.filter(x => !arrA.includes(x)))


const elementsInArrAOnly = arrA.filter(x => !arrB.includes(x));
const elementsInArrBOnly = arrB.filter(x => !arrA.includes(x));
const result = elementsInArrAOnly.concat(elementsInArrBOnly);