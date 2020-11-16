import React from 'react';
import ReactDOM from 'react-dom';
// import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';

document.querySelectorAll('.m5-coupMng').forEach(function(coupMng) {
  ReactDOM.render(
    <React.StrictMode>
      <App fUrl={coupMng.dataset.fUrl} inrow={coupMng.dataset.inrow} category={coupMng.dataset.category} type={coupMng.dataset.type} filters={coupMng.dataset.filters}/>
    </React.StrictMode>,
    coupMng
  );
});
// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
