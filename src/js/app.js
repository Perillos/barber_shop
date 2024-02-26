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
  // Añade la hora de la cita en el objeto
  seleccionarHora();

  // Muestra el resumen de la cita
  mostrarResumen();
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

  // Agrega y cambia la variable del paso según el tab seleccionado
  botones.forEach(boton => {
    boton.addEventListener('click', function (eve) {
      eve.preventDefault();

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
    mostrarResumen();
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
    divServicio.classList.remove('seleccionado');
  } else {
    // Agregarlo
    cita.servicios = [...servicios, servicio];
    divServicio.classList.add('seleccionado');
  }
}

function nombreCliente() {
  cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
  const inputFecha = document.querySelector('#fecha');
  inputFecha.addEventListener('input', function (eve) {
    const dia = new Date(eve.target.value).getUTCDay();

    if ([6, 0].includes(dia)) {
      eve.target.value = '';
      mostrarAlerta('Fines de semana no permitidos', 'error', '.formulario');
    } else {
      cita.fecha = eve.target.value;
    }
  });
}

function seleccionarHora() {
  const inputHora = document.querySelector('#hora');
  inputHora.addEventListener('input', function (eve) {
    const horaCita = eve.target.value;
    const hora = horaCita.split(':')[0];

    if (hora < 10 || hora > 18) {
      eve.target.value = '';
      mostrarAlerta('Hora no valida', 'error', '.formulario');
    } else {
      cita.hora = eve.target.value;
    }
  });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {
  // Previene que se generen más de una alerta
  const alertaPrevia = document.querySelector('.alerta');
  if (alertaPrevia) {
    alertaPrevia.remove();
  }

  // Scripting para crear la alerta
  const alerta = document.createElement('DIV');
  alerta.textContent = mensaje;
  alerta.classList.add('alerta');
  alerta.classList.add(tipo);

  const referencia = document.querySelector(elemento);
  referencia.appendChild(alerta);

  if (desaparece) {
    // Eliminar la alerta
    setTimeout(() => {
      alerta.remove();
    }, 3000);
  }
}

function mostrarResumen(params) {
  const resumen = document.querySelector('.contenido-resumen');

  // Limpiar el contenido de resumen
  while (resumen.firstChild) {
    resumen.removeChild(resumen.firstChild);
  }

  if (Object.values(cita).includes('') || cita.servicios.length === 0) {
    mostrarAlerta(
      'Faltan datos de servicios, fecha u hora',
      'error',
      '.contenido-resumen',
      false
    );

    return;
  }

  // Formatear el div de resumen
  const { nombre, fecha, hora, servicios } = cita;

  // Heading para servicios en resumen
  const headingServicios = document.createElement('H3');
  headingServicios.textContent = 'Resumen de servicios';
  resumen.appendChild(headingServicios);

  // Iterando y mostrando los servicios
  servicios.forEach(servicio => {
    const { id, precio, nombre } = servicio;
    const contenedorServicio = document.createElement('DIV');
    contenedorServicio.classList.add('contenedor-servicio');

    const textoServicio = document.createElement('P');
    textoServicio.textContent = nombre;

    const precioServicio = document.createElement('P');
    precioServicio.innerHTML = `<span>Hora:</span> $${precio}`;

    contenedorServicio.appendChild(textoServicio);
    contenedorServicio.appendChild(precioServicio);

    resumen.appendChild(contenedorServicio);
  });

  // Heading para servicios en cita
  const headingCita = document.createElement('H3');
  headingCita.textContent = 'Resumen de servicios';
  resumen.appendChild(headingCita);

  const nombreCliente = document.createElement('P');
  nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

  const fechaCita = document.createElement('P');
  fechaCita.innerHTML = `<span>Fecha:</span> ${fecha}`;

  const horaCita = document.createElement('P');
  horaCita.innerHTML = `<span>Hora:</span> ${hora} horas`;

  resumen.appendChild(nombreCliente);
  resumen.appendChild(fechaCita);
  resumen.appendChild(horaCita);
}
