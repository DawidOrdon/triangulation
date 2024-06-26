var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var size=30;

// Funkcja do rysowania osi układu XY
function drawAxes(width, height, unitStep) {
    // Rysowanie osi X
    context.beginPath();
    context.moveTo(0, height / 2);
    context.lineTo(width, height / 2);
    context.strokeStyle = 'black';
    context.stroke();

    // Rysowanie strzałki osi X
    context.beginPath();
    context.moveTo(width - 10, height / 2 - 5);
    context.lineTo(width, height / 2);
    context.lineTo(width - 10, height / 2 + 5);
    context.stroke();

    // Rysowanie podziałek i etykiet osi X
    for (let i = 0; i < width; i += unitStep) {
        if (i % (unitStep * size) === 0) { // Rysuj etykiety co unitStep * 10 pikseli
            context.beginPath();
            context.moveTo(i, height / 2 - 5);
            context.lineTo(i, height / 2 + 5);
            context.strokeStyle = 'black';
            context.stroke();
            context.fillStyle = 'black';
            context.fillText((i - width / 2) / 30, i - 5, height / 2 + 20);
        }
    }

    // Rysowanie osi Y
    context.beginPath();
    context.moveTo(width / 2, 0);
    context.lineTo(width / 2, height);
    context.strokeStyle = 'black';
    context.stroke();

    // Rysowanie strzałki osi Y
    context.beginPath();
    context.moveTo(width / 2 - 5, 10);
    context.lineTo(width / 2, 0);
    context.lineTo(width / 2 + 5, 10);
    context.stroke();

    // Rysowanie podziałek i etykiet osi Y
    for (let i = 0; i < height; i += unitStep) {
        if (i % (unitStep * size) === 0) { // Rysuj etykiety co unitStep * 10 pikseli
            context.beginPath();
            context.moveTo(width / 2 - 5, i);
            context.lineTo(width / 2 + 5, i);
            context.strokeStyle = 'black';
            context.stroke();
            context.fillStyle = 'black';
            context.fillText((-i + height / 2) / 30, width / 2 + 10, i + 5);
        }
    }
}

// Funkcja do rysowania obrysu figury
function drawPolygon(color, points) {
    context.strokeStyle = color;
    context.beginPath();
    context.moveTo(points[0][0] * size + canvas.width / 2, -points[0][1] * size + canvas.height / 2);
    for (var i = 1; i < points.length; i++) {
        context.lineTo(points[i][0] * size + canvas.width / 2, -points[i][1] * size + canvas.height / 2);
    }
    context.closePath();
    context.stroke();

    // Dodanie numeru wierzchołka na wszystkich wierzchołkach
    for (var i = 0; i < points.length; i++) {
        var x = points[i][0] * size + canvas.width / 2;
        var y = -points[i][1] * size + canvas.height / 2;
        var number = points[i][2]; // Zakładamy, że trzeci element to numer
        context.fillStyle = color; // Możesz ustawić inny kolor tekstu, jeśli chcesz
        context.fillText(number, x, y);
    }
}


// Funkcja do nanoszenia liter w określonych punktach
function drawLetters(points, letter) {
    context.fillStyle = 'black';
    context.font = '14px Arial';
    for (var i = 0; i < points.length; i++) {
        var x = points[i][0] * size + canvas.width / 2 - 20;
        var y = -points[i][1] * size + canvas.height / 2 + 5;
        context.fillText(letter, x, y);
    }
}
function drawLine(color, x1, y1, x2, y2) {
    context.strokeStyle = color;
    context.beginPath();
    context.moveTo(x1 * size + canvas.width / 2, -y1 * size + canvas.height / 2);
    context.lineTo(x2 * size + canvas.width / 2, -y2 * size + canvas.height / 2);
    context.closePath();
    context.stroke();
}

