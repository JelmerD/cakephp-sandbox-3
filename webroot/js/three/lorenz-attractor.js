var $container, w, h = 600;
var scene, camera, renderer, controls, running = true;
var geometry, material, mesh;

//https://en.wikipedia.org/wiki/Lorenz_system
var x = 1,
    y = 0,
    z = 0,
    o = 10, //omega
    r = 28, //rho
    b = 8 / 3, //beta
    t = 0.01; //time scale
var colorinc = 0.01; // color increment
var colorlim = [0.4, 0.9]; // color limits
var colorup = true; // color up or down (false = down)

var previous = new THREE.Vector3(x, y, z);

$(document).ready(function () {
    $container = $('#three-container');
    w = $container.innerWidth();
    $container.height(h);

    init();
    animate();
});

function init() {
    setVariable('o', 10);
    setVariable('r', 28);
    setVariable('b', 8/3);

    scene = new THREE.Scene();
    // fov, aspect, near, far
    camera = new THREE.PerspectiveCamera(80, w / h, 1, 2000);
    // zoom out
    camera.position.z = 100;

    material = new THREE.LineBasicMaterial({color: 0x999999});

    renderer = new THREE.WebGLRenderer();
    renderer.setSize(w, h);

    $container.append(renderer.domElement);


    controls = new THREE.OrbitControls(camera, renderer.domElement);
}

function animate() {
    if (!running) return;

    requestAnimationFrame(animate);
    setMaterialColor();

    var dx = (o * (y - x)) * t;
    var dy = (x * (r - z) - y) * t;
    var dz = ((x * y) - (b * z)) * t;
    x = x + dx;
    y = y + dy;
    z = z + dz;
    var current = new THREE.Vector3(x, y, z);
    var geometry = new THREE.Geometry();
    geometry.vertices.push(
        previous,
        current
    );
    previous = current.clone();

    scene.add(new THREE.Line(geometry, material.clone()));
    renderer.render(scene, camera);
}

function setMaterialColor() {
    var keys = Object.keys(material.color);
    var key = keys[ keys.length * Math.random() << 0];
    if (colorup) {
        material.color[key] += colorinc;
        if (material.color[key] >= colorlim[1]) {
            colorup = false;
        }
    } else {
        material.color[key] -= colorinc;
        if (material.color[key] <= colorlim[0]) {
            colorup = true;
        }
    }
}

function setVariable(variable, val) {
    if (val === undefined) {
        var val = $('#set-' + variable).val();
    } else {
        $('#set-' + variable).val(val);
    }
    $('.val-' + variable).html(val);
    window[variable] = val;
}

function clearCanvas() {
    running = false;
    while (scene.children.length > 0) {
        for (var key in scene.children) {
            scene.remove(scene.children[key]);
        }
    }
    renderer.render(scene, camera);
    running = true;
}