function autoSubmitForm() {
  document.getElementsByClassName('selectForm')[0].submit();
}

function getParameterByName(name, url = window.location.href) {
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
  var results = regex.exec(url);
  if(!results) {
    return null;
  }
  if(!results[2]) {
    return '';
  }

  return decodeURIComponent(results[2].replace(/\+/g, ''));
}

document.addEventListener('DOMContentLoaded', (event) => {
  var selectedRegion = getParameterByName('option');
  var selectElement = document.getElementById("option");
  if(selectedRegion) {
    selectElement.value = selectedRegion;
  } else {
    selectElement.value = "USA";
  }

  console.log(selectElement.value);

  var urlParameters = new URLSearchParams(window.location.search);

  var paramsArray = [];

  urlParameters.forEach((value, key) => {
    paramsArray[key] = value;
  });

  // var currentOption = document.getElementById("current_opt");
  // currentOption.value = paramsArray["option"];
  // currentOption.innerHTML = paramsArray["option"];

});

// document.getElementById('search_form').addEventListener('submit', function (event){
//   event.preventDefault(); // Зупиняємо стандартну поведінку форми
//
//   const searchInput = document.getElementById('search').value;
//   const urlParams = new URLSearchParams(window.location.search);
//
//   // Додаємо новий параметр search або оновлюємо існуючий
//   urlParams.set('search', searchInput);
//
//   console.log(urlParams.toString());
//
//   // Оновлюємо URL без перезавантаження сторінки
//   const newUrl = `${window.location.pathname}?${urlParams.toString()}`;
//   console.log(newUrl);
//   window.history.pushState({ path: newUrl }, '', newUrl);
//   console.log(window.history);
//
//   // Виконуємо запит для отримання результатів пошуку
//   fetch(newUrl, {
//     headers: {
//       'X-Requested-With': 'XMLHttpRequest'
//     }
//   })
//     .then(response => response.text())
//     .then(data => {
//       // Відображаємо отримані результати в контейнері
//       document.getElementById('body').innerHTML = data;
//     })
//     .catch(error => console.error('Error:', error));
// })

// document.getElementById('reaction-form').addEventListener('submit', function(e) {
//   e.preventDefault();
//   const form = e.target;
//   const postId = form.getAttribute('data-post-id');
//   const emoji = form.reaction.value;
//
//   fetch(`/posts/${postId}/reactions`, {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json',
//       'X-CSRF-TOKEN': '{{ csrf_token() }}'
//     },
//     body: JSON.stringify({ emoji: emoji })
//   })
//     .then(response => response.json())
//     .then(data => {
//       if (data.success) {
//         console.log('Reaction added successfully!');
//         // тут можна оновити UI
//       }
//     });
// });

