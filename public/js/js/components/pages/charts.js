import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Header from 'components/header';
import Logo from 'components/logo';
import NavbarTop from 'components/navbar-top';
import SearchBar from 'components/search-bar';
import Content from 'components/content';
import HomeChart from 'components/home-chart';


export default class Home extends Component {
    render() {
        return (
            <Header>
                <Logo/>
                <NavbarTop>
                    <li><a href="">Charts</a></li>
                    <li><a href="">Artist Archives</a></li>
                    <li><a href="">Charts</a></li>
                    <li><a href="">Charts</a></li>
                    <li>
                        <SearchBar/>
                    </li>
                </NavbarTop>
            </Header>
            <Content>
                <HomeChart color="blue" img="" name="" no1-music="" no1-artist="" link=""/>
                <HomeChart color="green" img="" name="" no1-music="" no1-artist="" link=""/>
                <HomeChart color="red" img="" name="" no1-music="" no1-artist="" link=""/>
                <HomeChart color="yellow" img="" name="" no1-music="" no1-artist="" link=""/>
                <HomeChart color="purple" img="" name="" no1-music="" no1-artist="" link=""/>
                <HomeChart color="magenta" img="" name="" no1-music="" no1-artist="" link=""/>
                <HomeChart color="cyan" img="" name="" no1-music="" no1-artist="" link=""/>
                <HomeChart color="orange" img="" name="" no1-music="" no1-artist="" link=""/>
            </Content>
            <Footer/>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(<Home />, document.getElementById('root'));
}
