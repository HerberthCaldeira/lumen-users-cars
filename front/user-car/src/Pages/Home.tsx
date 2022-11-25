import { Link } from "react-router-dom";

const Home = () => {

    return (
        <div>
            Links
            <ul>
                <li><Link to={'/user'}> User</Link></li>
                <li><Link to={'/users'}> Users</Link></li>
                <li><Link to={'/createuser'}> Create User</Link></li>
                <li><Link to={'/useredit'}> User edit</Link></li>
                <li><Link to={'/userdelete'}> User delete</Link></li>
                <li><Link to={'/userattachcar'}> User attach car</Link></li>
                <li><Link to={'/userdetachcar'}> User detach car</Link></li>
                <li><Link to={'/car'}> Car </Link></li>
                <li><Link to={'/createcar'}> Create Car</Link></li>
                <li><Link to={'/cars'}> Cars </Link></li>
                <li><Link to={'/caredit'}> Cars edit</Link></li>
                <li><Link to={'/CarDelete'}> Car Delete</Link></li>
            </ul>
        </div>

    )

}


export default Home;