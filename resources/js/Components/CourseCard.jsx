// In your Courses.js or a new CourseCard.js component
import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';

const CourseCard = ({ course }) => {
  return (
    <div className="max-w-sm rounded overflow-hidden shadow-lg cursor-pointer">
      <img className="w-full" src={course.image} alt={course.name} />
      <div className="px-6 py-4">
        <div className="font-bold text-xl mb-2 text-center">{course.name}</div>
        <InertiaLink href={`/courses/${course.id}`} className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          View Details
        </InertiaLink>
      </div>
    </div>
  );
};

export default CourseCard;