export function parsePrice(priceStr) {
    const numericalPart = priceStr.replace(/[^\d.-]/g, '');
    return parseFloat(numericalPart);
}
