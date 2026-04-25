const productos= [
    //proyectos
    {
        id:"1",
        titulo:"Pasteleria",
        categoria:{
            nombre: "Proyectos",
            id:"proyectos",
        },
        precio: 300,
    },
    {
        id:"2",
        titulo:"Ferreteria",
        categoria:{
            nombre:"Proyectos",
            id:"proyectos",
        },
        precio: 600,
    },
    {
        id:"3",
        titulo:"Restaurante",
        categoria:{
            nombre: "Proyectos",
            id:"proyectos",
        },
        precio: 300,
    },
    {
        id:"4",
        titulo:"Florería",
        categoria:{
            nombre: "Proyectos",
            id:"proyectos",
        },
        precio: 900,
    },
    //planes 
    {
        id:"5",
        titulo:"Emprendedor",
        categoria:{
            nombre: "Planes",
            id:"planes",
        },
        precio: 300,
    },
    {
        id:"6",
        titulo:"Bussines",
        categoria:{
            nombre: "Planes",
            id:"planes",
        },
        precio: 600,
    },  {
        id:"7",
        titulo:"EEcommerce",
        categoria:{
            nombre: "Planes",
            id:"planes",
        },
        precio: 900,
    }
];


const contenedorProductos = document.querySelector("#contenedor-productos");
const numero = document.querySelector(".numero");
let productocarrito = JSON.parse(localStorage.getItem('productocarrito')) || [];
let productosComprados = JSON.parse(localStorage.getItem('productosComprados')) || {};

function cargarProductos(productosElegidos) {
    contenedorProductos.innerHTML = "";

    productosElegidos.forEach(producto => {
        const div = document.createElement("div");
        div.classList.add("producto");
        div.textContent = `${producto.titulo} - ${producto.precio} - ${producto.categoria.nombre}`;
        contenedorProductos.appendChild(div);
    });
}

function agregarAlCarrito(idProducto) {
    if (productosComprados[idProducto]) {
        console.log('Este producto ya ha sido agregado al carrito.');
    } else {
        
        const producto = {
            id: idProducto,
            cantidad: 1 
        };

        productocarrito.push(producto);
        productosComprados[idProducto] = true;

        console.log('Producto agregado al carrito:', idProducto);

      
        localStorage.setItem('productocarrito', JSON.stringify(productocarrito));
        localStorage.setItem('productosComprados', JSON.stringify(productosComprados));

        
        actualizarNumero();
    }
}

function actualizarNumero() {
    let nuevonumero = productocarrito.reduce((acc, producto) => acc + producto.cantidad, 0);
    numero.innerText = nuevonumero;
}

document.addEventListener('DOMContentLoaded', function() {
    const botonesCompra = document.querySelectorAll('.btn');
    
    botonesCompra.forEach(function(boton) {
        boton.addEventListener('click', function() {
            const idProducto = boton.id; 
            agregarAlCarrito(idProducto);
        });
    });

    actualizarNumero();
});

const eliminar = document.querySelectorAll('.eliminar-btn');

eliminar.forEach((button, index) => {
    button.addEventListener('click', () => {
       
        carrito.eliminarProducto(index + 1); 
        
       
    });
});

