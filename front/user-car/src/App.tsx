import React from 'react';
import { Routes, Route } from "react-router-dom";
import { BrowserRouter } from "react-router-dom";
import { QueryClient, QueryClientProvider, useQuery } from 'react-query'
import User from "./Pages/Users/User";
import Users from "./Pages/Users/Users";
import CreateUser from "./Pages/Users/CreateUser";
import UserEdit from "./Pages/Users/UserEdit";
import UserDelete from "./Pages/Users/UserDelete";
import UserAttachCar from "./Pages/Users/UserAttachCar";
import UserDetachCar from "./Pages/Users/UserDetachCar";
import Car from './Pages/Cars/Car';
import CreateCar from "./Pages/Cars/CreateCar";
import Cars from "./Pages/Cars/Cars";
import CarEdit from "./Pages/Cars/CarEdit";
import CarDelete from "./Pages/Cars/CarDelete";
import Home from './Pages/Home';

const queryClient = new QueryClient()


function App() {
  return (
    <div className="App">
        <QueryClientProvider client={queryClient}>
            <Routes>
                <Route  path="/" element={ <Home/>} />
                <Route  path="/user" element={ <User/>} />
                <Route  path="/users" element={ <Users/>} />
                <Route  path="/createuser" element={ <CreateUser/>} />
                <Route  path="/useredit" element={ <UserEdit/>} />
                <Route  path="/userdelete" element={ <UserDelete/>} />
                <Route  path="/userattachcar" element={ <UserAttachCar/>} />
                <Route  path="/userdetachcar" element={ <UserDetachCar/>} />
                <Route  path="/car" element={ <Car/>} />
                <Route  path="/createcar" element={ <CreateCar/>} />
                <Route  path="/cars" element={ <Cars/>} />
                <Route  path="/caredit" element={ <CarEdit/>} />
                <Route  path="/CarDelete" element={ <CarDelete/>} />
            </Routes>
        </QueryClientProvider>
    </div>
  );
}

export default App;
