import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Link } from "@inertiajs/react";

export default function CourseDetail({ course, auth }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {course.name}
                </h2>
            }
        >
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-between">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-grow">
                        <div className="p-6 text-gray-900 flex flex-col items-center">
                            <img
                                src={course.image}
                                alt="Course"
                                className="w-48 h-48 object-cover"
                            />
                            <div>Course: Name: {course.name}</div>
                        </div>
                    </div>
                    <div className="ml-4 w-96 bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6">
                            <h2 className="font-semibold text-lg">
                                Course Details
                            </h2>
                            <p>Participants: {course.count}</p>

                            <Link
                            href={route('course.edit', course.id)}
                                as="button"
                                className="mt-4 px-4 py-2 bg-blue-500 text-white rounded"
                            >
                                Edit
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
