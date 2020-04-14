import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Header from '../../blocks/header.js';
import Footer from '../../blocks/footer.js';
import Logo from '../../blocks/logo.js';
import NavbarTop from '../../blocks/navbar-top.js';
import SearchBar from '../../blocks/search-bar.js';
import Content from '../../blocks/content.js';
import HomeChart from '../../blocks/home-chart.js';


export default class Charts extends Component {
    render() {
        return (
            <div>
                <Header>
                    <Logo/>
                    <NavbarTop>
                        <li><a href="/">Charts</a></li>
                        <li><a href="/charts/1">Artist Archives</a></li>
                        <li><a href="/archive">Archives</a></li>
                        <li><a href="/archive/1">Archive Singles</a></li>
                        <li>
                            <SearchBar/>
                        </li>
                    </NavbarTop>
                </Header>
                <Content>
                    <HomeChart color="blue" img="" name="" no1Music="King Nothing" no1Artist="Metallica" link="https://www.youtube.com/watch?v=V5j8lz4oD4Q"/>
                    <HomeChart color="green" img="" name="" no1Music="War Horns" no1Artist="Angra" link="https://www.youtube.com/watch?v=Dgor7ZuG9nU"/>
                    <HomeChart color="red" img="" name="" no1Music="Love Train" no1Artist="The O'Jays" link="https://www.youtube.com/watch?v=2vTKmVvyNRc"/>
                    <HomeChart color="yellow" img="" name="" no1Music="Glory of the World" no1Artist="Stratovarius" link="https://www.youtube.com/watch?v=tzvY77AmLtw"/>
                    <HomeChart color="purple" img="" name="" no1Music="Harlequin Forest" no1Artist="Opeth" link="https://www.youtube.com/watch?v=nIo3lpXrc5A"/>
                    <HomeChart color="magenta" img="" name="" no1Music="Like a Child" no1Artist="Noel" link="https://www.youtube.com/watch?v=823P49o4qmI"/>
                    <HomeChart color="cyan" img="" name="" no1Music="People are People" no1Artist="Depeche Mode" link="https://www.youtube.com/watch?v=MzGnX-MbYE4"/>
                    <HomeChart color="orange" img="" name="" no1Music="Mad World" no1Artist="Tears for Fears" link="https://www.youtube.com/watch?v=u1ZvPSpLxCg"/>
                </Content>
                <Footer/>
            </div>
        );
    }
}

if (document.getElementById('root-charts')) {
    ReactDOM.render(<Charts />, document.getElementById('root-charts'));
}
