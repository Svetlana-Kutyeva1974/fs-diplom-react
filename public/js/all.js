const headers = Array.from(document.querySelectorAll('.conf-step__header'));
headers.forEach(header => header.addEventListener('click', () => {
  header.classList.toggle('conf-step__header_closed');
  header.classList.toggle('conf-step__header_opened');
}));
  import React from 'react';
  import ReactDOM from 'react-dom';

    ReactDOM.render(
      <h1>Hello, world!</h1>,
      document.getElementById('root')
    );