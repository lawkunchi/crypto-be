import React from "react";
import { Link } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

export default function CoursesList({ courses, auth }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Add Course
                </h2>
            }
        >
            <div className="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" className="py-3 px-6">
                                Course Name
                            </th>
                            <th scope="col" className="py-3 px-6">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {courses.map((course) => (
                            <tr
                                key={course.id}
                                className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                <td className="py-4 px-6">{course.name}</td>
                                <td className="py-4 px-6">
                                    <Link
                                        href={route("course.edit", course.id)}
                                        className="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    >
                                        Edit
                                    </Link>
                                    <Link
                                        href={route("course.delete", course.id)}
                                        method="delete"
                                        as="button"
                                        className="font-medium text-red-600 dark:text-red-500 hover:underline ml-4"
                                    >
                                        Delete
                                    </Link>
                                    <Link
                                        href={route("course.view", course.id)}
                                        className="font-medium text-green-600 dark:text-green-500 hover:underline ml-4"
                                    >
                                        View
                                    </Link>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </AuthenticatedLayout>
    );
}
