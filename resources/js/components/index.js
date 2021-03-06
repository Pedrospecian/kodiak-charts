import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Home extends Component {
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">Kodiak Charts</div>

                            <div className="card-body">Aqui virão listas de músicas.</div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(<Home />, document.getElementById('root'));
}
