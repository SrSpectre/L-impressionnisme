export const getMargins = (element) => [element.getElementsByClassName('margin-title')[0], element.getElementsByClassName('margin-title-rev')[0]];

export const getRandomInRange = (min, max) => Math.random() * (max - min) + min;