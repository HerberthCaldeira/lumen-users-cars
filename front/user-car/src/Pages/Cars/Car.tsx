
import { useQuery } from 'react-query'
import api from '../../Services/Api'

const Car = () => {
    const { isLoading, error, data } = useQuery('car', async () => {
        const response = await api.get('/car/1' );
        return response.data;
    })

    return (
        <div>
            <h1> car </h1>
            <pre> { JSON.stringify(data, null, 2) } </pre>
        </div>
    )
}

export default Car;