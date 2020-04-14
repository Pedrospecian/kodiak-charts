import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Header from '../../blocks/header';
import Content from '../../blocks/content';
import Footer from '../../blocks/footer';

export default class ChartsSingle extends Component {
    render() {
        return (
            <div>chart single</div>
        );
    }
}

if (document.getElementById('root-chart-single')) {
    ReactDOM.render(<ChartSingle />, document.getElementById('root-chart-single'));
}
