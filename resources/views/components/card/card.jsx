import './card.css';

export function Card(children,props){
    return(
        <div className='card-container'>
            <h2 className="card-title">{props.title}</h2>
            {children}
        </div>
    )
}
