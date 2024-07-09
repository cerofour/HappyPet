document.addEventListener('DOMContentLoaded', () => {
    const citaForm = document.getElementById('citaForm');
    const citasList = document.getElementById('citasList');
  
    function renderCitas(citas) {
      citasList.innerHTML = '';
      citas.forEach((cita) => {
        const li = document.createElement('li');
        li.innerHTML = `
          <strong>${cita.nombreMascota}</strong> (${cita.tipoMascota})<br>
          Fecha: ${cita.fecha} - Hora: ${cita.hora}<br>
          Motivo: ${cita.motivo}<br>
          <button onclick="editarCita(${cita.id})">Editar</button>
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
  
    citaForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const citaId = document.getElementById('citaId').value;
      const cita = {
        nombreMascota: document.getElementById('nombreMascota').value,
        tipoMascota: document.getElementById('tipoMascota').value,
        fecha: document.getElementById('fecha').value,
        hora: document.getElementById('hora').value,
        motivo: document.getElementById('motivo').value
      };
  
      try {
        if (citaId) {
          await fetch(`api.php/citas/${citaId}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(cita)
          });
        } else {
          await fetch('api.php/citas', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(cita)
          });
        }
        citaForm.reset();
        document.getElementById('citaId').value = '';
        getCitas();
      } catch (error) {
        console.error('Error al guardar cita:', error);
      }
    });
  
    window.editarCita = async (id) => {
      try {
        const response = await fetch(`api.php/citas/${id}`);
        const cita = await response.json();
        document.getElementById('citaId').value = cita.id;
        document.getElementById('nombreMascota').value = cita.nombreMascota;
        document.getElementById('tipoMascota').value = cita.tipoMascota;
        document.getElementById('fecha').value = cita.fecha;
        document.getElementById('hora').value = cita.hora;
        document.getElementById('motivo').value = cita.motivo;
        document.querySelector('#submitBtn').textContent = 'Actualizar Cita';
      } catch (error) {
        console.error('Error al obtener cita para editar:', error);
      }
    };
  
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