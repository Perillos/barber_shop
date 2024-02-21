let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
  nombre: '',
  fecha: '',
  hora: '',
  servicios: [],
};

document.addEventListener('DOMContentLoaded', function () {
  iniciarApp();
});

function iniciarApp() {
  // Muestra y oculta las secciones
  mostrarSeccion();
  // Cambia la sección cuando se presionen los tabs
  tabs();
  // Agrega o quita los bontones del paginador
  botonesPaginador();
  paginaAnterior();
  paginaSiguiente();

  // Consutla la API en el backenD en el PHP
  consultaAPI();

  // Añade el nombre del cliente al objeto cita
  nombreCliente();
  // Añade la fecha de la cita en el objeto
  seleccionarFecha();
}

function mostrarSeccion() {
  // Oculatar la sección que tenga la clase de mostrar
  const seccionAnterior = document.querySelector('.mostrar');
  if (seccionAnterior) {
    seccionAnterior.classList.remove('mostrar');
  }

  // Seleccionar la sección con el paso
  const pasoSelector = `#paso-${paso}`;
  const seccion = document.querySelector(pasoSelector);
  seccion.classList.add('mostrar');

  // Quita la clase de actual al tab anterior
  const tabAnterior = document.querySelector('.actual');
  if (tabAnterior) {
    tabAnterior.classList.remove('actual');
  }

  // Resalta el tab actual
  const tab = document.querySelector(`[data-paso="${paso}"]`);
  tab.classList.add('actual');
}

function tabs() {
  const botones = document.querySelectorAll('.tabs button');

  botones.forEach(boton => {
    boton.addEventListener('click', function (eve) {
      paso = parseInt(eve.target.dataset.paso);

      mostrarSeccion();
      botonesPaginador();
    });
  });
}

function botonesPaginador() {
  const paginaAnterior = document.querySelector('#anterior');
  const paginaSiguiente = document.querySelector('#siguiente');

  if (paso === 1) {
    paginaAnterior.classList.add('ocultar');
    paginaSiguiente.classList.remove('ocultar');
  } else if (paso === 3) {
    paginaAnterior.classList.remove('ocultar');
    paginaSiguiente.classList.add('ocultar');
  } else {
    paginaAnterior.classList.remove('ocultar');
    paginaSiguiente.classList.remove('ocultar');
  }

  mostrarSeccion();
}

function paginaAnterior() {
  const paginaAnterior = document.querySelector('#anterior');
  paginaAnterior.addEventListener('click', function () {
    if (paso <= pasoInicial) return;
    paso--;

    botonesPaginador();
  });
}
function paginaSiguiente() {
  const paginaSiguiente = document.querySelector('#siguiente');
  paginaSiguiente.addEventListener('click', function () {
    if (paso >= pasoFinal) return;
    paso++;

    botonesPaginador();
  });
}

async function consultaAPI() {
  try {
    const url = 'http://localhost:3001/api/servicios';

    const resultado = await fetch(url);
    const servicios = await resultado.json();
    mostrarServicios(servicios);
  } catch (error) {
    console.log(error);
  }
}

function mostrarServicios(servicios) {
  servicios.forEach(servicio => {
    const { id, nombre, precio } = servicio;

    const nombreServicio = document.createElement('P');
    nombreServicio.classList.add('nombre-servicio');
    nombreServicio.textContent = nombre;

    const precioServicio = document.createElement('P');
    precioServicio.classList.add('precio-servicio');
    precioServicio.textContent = `$ ${precio}`;

    const servicioDiv = document.createElement('DIV');
    servicioDiv.classList.add('servicio');
    servicioDiv.dataset.idServicio = id;
    servicioDiv.onclick = function () {
      seleccionarServicio(servicio);
    };

    servicioDiv.appendChild(nombreServicio);
    servicioDiv.appendChild(precioServicio);

    document.querySelector('#servicios').appendChild(servicioDiv);
  });
}

function seleccionarServicio(servicio) {
  const { id } = servicio;
  const { servicios } = cita;

  // Identificar el elemento al que se le dá click
  const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

  // Comprobar si un servicio ya fue agregado
  if (servicios.some(agregado => agregado.id === id)) {
    // Eliminarlo
    cita.servicios = servicios.filter(agregado => agregado.id !== id);
    console.log('Ya esta agreado');
    divServicio.classList.remove('seleccionado');
  } else {
    // Agregarlo
    cita.servicios = [...servicios, servicio];
    divServicio.classList.add('seleccionado');
  }

  console.log(cita);
}

function nombreCliente() {
  cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
  const inputFecha = document.querySelector('#fecha');
  inputFecha.addEventListener('input', function (eve) {
    const dia = new Date(eve.target.value).getUTCDate();

    if ([6, 0].includes(dia)) {
      eve.target.value = '';
      mostrarAlerta('Fines de semana no permitidos', 'error');
    } else {
      cita.fecha = eve.target.value;
    }
  });
}

function mostrarAlerta(mensaje, tipo) {
  // Previene que se generen más de una alerta
  const alertaPrevia = document.querySelector('.alerta');
  if (alertaPrevia) {
    return;
  }

  // Scripting para crear la alerta
  const alerta = document.createElement('DIV');
  alerta.textContent = mensaje;
  alerta.classList.add('alerta');
  alerta.classList.add(tipo);

  const formulario = document.querySelector('.formulario');
  formulario.appendChild(alerta);

  // Eliminar la alerta
  setTimeout(() => {
    alerta.remove();
  }, 3000);
}
