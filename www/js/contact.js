console.log('contact.js loaded');
document.addEventListener('DOMContentLoaded', () => {
    const citasList = document.getElementsByClassName('citas-list')[0];
  
    function renderCitas(citas) {
      citasList.innerHTML = '';
      citas.forEach((cita) => {
        const li = document.createElement('li');
        li.innerHTML = `
          <strong>${cita.nombreMascota}</strong> (${cita.tipoMascota})<br>
          Fecha: ${cita.fecha} - Hora: ${cita.hora}<br>
          Motivo: ${cita.motivo}<br>
          <button onclick="eliminarCita(${cita.id})">Eliminar</button>
        `;
        citasList.appendChild(li);
      });
    }
  
    async function getCitas() {
      try {
        const response = await fetch('api.php/citas');
        const citas = await response.json();
        renderCitas(citas);
      } catch (error) {
        console.error('Error al obtener citas:', error);
      }
    }
  
    window.eliminarCita = async (id) => {
      if (confirm('¿Estás seguro de que quieres eliminar esta cita?')) {
        try {
          await fetch(`api.php/citas/${id}`, { method: 'DELETE' });
          getCitas();
        } catch (error) {
          console.error('Error al eliminar cita:', error);
        }
      }
    };
  
    getCitas();
  });
  
  document.getElementById('intranetButton').addEventListener('click', function() {
    window.location.href = 'login.php';
  });